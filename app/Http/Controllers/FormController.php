<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class FormController extends Controller
{
    public function bulk(Request $request, $type)
    {
        // Resolve model name dynamically
        $modelName = 'App\\Models\\' . ucfirst($type);
        $modelInstance = resolve($modelName);

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt,|max:2048',
        ]);

        $file = $request->file('csv_file');
        $filename = $file->getClientOriginalName(); //filename
        $csvData = array_map('str_getcsv', file($file->getRealPath()));

        // Skip the first line (header)
        array_shift($csvData);
        
        [$relations, $relationIds, $relationFields] = property_exists($modelInstance, 'relations') ? $modelInstance->getRelationsProperty() : [[], [], []];

        $fillable = $modelInstance->getFillable();
        $columns = array_diff($fillable, ['created_by', 'updated_by']);

        $currentUserId = auth()->id();
        $generatedIds = [];

        $validationErrors = [];
        $validatedRows = [];

        DB::beginTransaction();

        $rules = $modelInstance::validationRules();
        

        foreach ($csvData as $key => $row) {
            $row = array_map('trim', $row);
            if (empty(array_filter($row))) {
                continue;
            }
            
            if (count($row) !== count($columns)) {
                $validationErrors[] = [
                    'row' => $key + 1,
                    'errors' => ['CSV column count does not match the expected number of columns. Expected: ' . count($columns) . '. Actual: ' . count($row)],
                ];
                continue;
            }

            $data = array_combine($columns, $row);

            foreach ($data as $field => $value) {
                if (isset($rules[$field]) && is_array($rules[$field])){
                    if (in_array('nullable', $rules[$field]) && empty($value)) {
                        $data[$field] = null;
                    }
                } elseif (isset($rules[$field]) && str_contains($rules[$field], 'nullable') && empty($value)) {
                    $data[$field] = null;
                }
            }

            foreach ($data as $field => $value) {
                $relationIndex = array_search($field, $relationIds);
                if ($relationIndex !== false && $value !== null) {
                    $relation = $relations[$relationIndex]; 
                    $relationId = $relationIds[$relationIndex];
                    $fieldName = $relationFields[$relationIndex];
                    $relatedModel = $modelInstance->$relation()->getRelated();
    
                    $relatedEntry = $relatedModel::where($fieldName, $value)->first();
    
                    if ($relatedEntry) {
                        $data[$field] = $relatedEntry->id;
                    } else {
                        // If relation lookup fails, log an error for this row
                        $tempName = ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $fieldName)));
                        $tempRelationName = ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relationId)));
                        $validationErrors[] = [
                            'row' => $key + 1,
                            'errors' => ["{$tempName}: {$value} could not be found. Please check the CSV or the corresponding reference table: {$tempRelationName}."],
                        ];
                        continue 2; // Skip this row if relation lookup fails
                    }
                }
    
                if (!in_array($field, $relationIds) && isset($rules[$field]) && is_array($rules[$field])) {
                    if (in_array('nullable', $rules[$field]) && empty($value)) {
                        $data[$field] = null;
                    }
                } elseif (!in_array($field, $relationIds) && isset($rules[$field]) && str_contains($rules[$field], 'nullable') && empty($value)) {
                    $data[$field] = null;
                }
            }

            $data['created_by'] = $currentUserId;
            $data['updated_by'] = null;

            $rules = $modelInstance::validationRules();
            unset($rules['updated_by']); 

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $validationErrors[] = [
                    'row' => $key + 1,
                    'errors' => $validator->errors()->all(),
                ];
            } else {
                $validatedRows[] = $data;

                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }
                $generatedIds[] = $modelInstance->create($data)->id;
            }
        }


        if (!empty($validationErrors)) {
            DB::rollBack();
            return response()->json([
                'reponse_message' => 'Entries processed with the following error(s):',
                'errors' => $validationErrors,
                'status' => 'error',
            ]);
        }
        try{
            $bulkUploadHistory = \App\Models\BulkHistory::create([
                'filename' => $filename,
                'model' => $type,
                'generated_ids' => JSON_encode($generatedIds),
                'created_by' => $currentUserId,
            ]);
        } catch (\Exception $e) {
            $validationErrors[] = "Failed to create bulk upload history: {$e->getMessage()}";
        }

        DB::commit();

        // Return validation results and success message
        return response()->json([
            'reponse_message' => 'Entries processed successfully',
            'validated_rows' => $validatedRows,
            'validation_errors' => $validationErrors,
        ]);
    }



    public function show($type, $id = null)
    {
        try{
            $modelName = 'App\\Models\\' . ucfirst($type);
            $modelInstance = resolve($modelName);
            return $modelInstance;
            $entry = is_null($id) 
                ? tap(new $modelInstance)->fill(array_fill_keys($modelInstance->getFillable(), null))
                : $modelInstance::find($id);
            $fields = $entry->getAttributes();
            // dd($entry);
            list($relations, $relationIds, $relation_fields) = $entry->getRelationsProperty();
            // print('START');
            // dd($relationIds);
            // print("END");
            // dd($entry);
            $relationsAssoc = [];
            $relationships = [];
            foreach ($relationIds as $index => $relationId) {
                $relationsAssoc[$relationId] = $relation_fields[$index];
                $relationships[$relationId] = $relations[$index];
            }
            // dd($relations);
            $relatedData = [];
            foreach ($relations as $relation) {
                // dd($relations);
                if (method_exists($modelInstance, $relation)) {
                    // dd($modelInstance->name()->getModel());
                    $relatedModel = $modelInstance->$relation()->getModel();
                    // dd($relatedModel);
                    $relatedData[$relation] = $relatedModel::all();
                }
            }
            // dd($fields);
            $rules = $modelInstance::validationRules($id);
            // print('START');
            // dd($fields);
            // print("END");
            $fields = $entry->getAttributes();
            // print('START');
            // dd($fields);
            // print("END");
            $user_data = Auth::user();
            // dd($user_data);
            // dd($relatedData);
            return response()->json([
                'fields' => $fields,
                'relatedData' => $relatedData,
                'relationsAssoc' => $relationsAssoc,
                'relations' => $relations,
                'relatedIds' => $relationIds,
                'relation_fields' => $relation_fields,
                'relationships' => $relationships,
                'rules' => $rules
            ]);
        } catch (\Exception $e) {
            Log::error("Error in FormController@show: " . $e->getMessage());
            return abort(500, "Internal Server Error.");
        }
    }

    // FOR DISPLAYING THE TABLE
    public function display(Request $request = null, $type){
        $modelName = 'App\\Models\\' . ucfirst($type);
        $modelInstance = resolve($modelName);
        if ($request->ajax()) {
            return response()->json([
                'data' => $modelInstance->all(), 
                'columns' => $modelInstance->getFillable(),
                200,
            ]);
        }
        [$relations, $relation_ids, $relation_fields] = property_exists($modelInstance, 'relations') ? $modelInstance->getRelationsProperty() : [[], [], []];
        $modelClass = $modelInstance->with($relations)->get();
        // dd($modelClass);
        $data = $modelClass->map(function ($item) use ($relations, $relation_ids, $relation_fields, $modelName) {
            $newItem = (new $modelName())->fill([]);
            foreach ($relations as $index => $relation) {
                $relation_id = $relation_ids[$index] ?? null;
                if($relation_id === "created_by" || $relation_id === "updated_by") continue;
                // if($relation_id === "college_id" || $relation_id != "unit_id") {
                //     if(Auth::user()->unit_id != null) {
                //         if(Auth::user()->unit_id == $item->$relation->{ $relation_fields[$index] }) {
                //             $item->{ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relation_id)))} = $item->$relation->{ $relation_fields[$index] } ?? 'N/A';
                //         } else {
                //             continue;
                //         }
                //     }
                // }
                $item->{ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relation_id)))} = $item->$relation->{ $relation_fields[$index] } ?? 'N/A';
                unset($item->$relation_id);
            }
            foreach ($relations as $index => $relation) {
                $relation_id = $relation_ids[$index] ?? null;
                if($relation_id != "created_by" && $relation_id != "updated_by") continue;
                $item->{ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relation_id)))} = $item->$relation->{ $relation_fields[$index] } ?? 'N/A';
                unset($item->$relation_id);
            }
            return $item;
        });
        // dd($data);
        
        //APPLY COLLEGE LEVEL FILTERING
        if(Auth::user()->role_id == 3) {
            $college = \App\Models\College::find(Auth::user()->unit_id);
            $college_name = $college->shortname;
            // dd($college_name);
            $data = $data->filter(function ($item) use ($college_name) {
                if($item->College) {
                    return $item->College === $college_name;
                } elseif ($item->Unit) {
                    return $item->Unit === $college_name;
                }
            });
        }
        // dd($data);
        
        return view('components.table')->with('type', $type)->with('entries', $data)->with('title', ucwords(preg_replace('/([a-z])([A-Z])/', '$1 $2',ucfirst(str_replace('_', ' ',($modelInstance->getTable()))))));
    }
    
    public function store(Request $request, $type)
    {
        $modelName = 'App\\Models\\' . ucfirst($type);

        if (!class_exists($modelName)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $modelInstance = resolve($modelName);
        $entry = new $modelInstance;
        $rules = $modelInstance::validationRules();
        $validated = $request->validate($rules);
        // dd($validated);

        // Hash the password if it exists in the validated data
        if (array_key_exists('password', $rules)) {
            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }
        }

        // Set created_by to the current user's ID
        $validated['created_by'] = Auth::id(); 
        $validated['updated_by'] = null;

        $entry->fill($validated);
        $entry->save();

        if ($entry) {
            $entries = $modelInstance->with($modelInstance->relations ?? [])->get();

            $data = $entries->map(function ($item) use ($modelInstance) {
                $fields = $item->getAttributes();
                [$relations, $relation_ids] = property_exists($modelInstance, 'relations') ? $modelInstance->getRelationsProperty() : [[], []];
                
                // Exclude fields listed in $relation_ids
                foreach ($relation_ids as $relation_id) {
                    if (array_key_exists($relation_id, $fields)) {
                        unset($fields[$relation_id]);
                    }
                }
                
                foreach ($relations as $index => $relation) {
                    $relation_id = $relation_ids[$index] ?? null;
                    if ($item->$relation) {
                        $fields[ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relation_id)))] = $item->$relation->$relation ?? 'N/A';
                    }
                }
                return $fields;
            });
            return response()->json([
                'success' => 'Entry added successfully',
                'entries' => $data
            ]);
        }

        return response()->json(['error' => 'Entry not found'], 404);
    }

    public function update(Request $request, $type, $id)
    {
        $modelName = 'App\\Models\\' . ucfirst($type);

        if (!class_exists($modelName)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $modelInstance = resolve($modelName);
        $entry = $modelInstance::find($id);

        if ($entry) {
            $rules = $modelInstance::validationRules($id);
            $validated = $request->validate($rules);
            if (array_key_exists('password', $rules)) {
                if (isset($validated['password'])) {
                    $validated['password'] = Hash::make($validated['password']);
                }
            }

            $validated['updated_by'] = Auth::id();
            if ($entry->created_by !== null) {
                $validated['created_by'] = $entry->created_by;
            }
            
            $entry->update($validated);

            $entries = $modelInstance->with($modelInstance->relations ?? [])->get();

            $data = $entries->map(function ($item) use ($modelInstance) {
                $fields = $item->getAttributes();
                [$relations, $relation_ids] = property_exists($modelInstance, 'relations') ? $modelInstance->getRelationsProperty() : [[], []];
                
                // Exclude fields listed in $relation_ids
                foreach ($relation_ids as $relation_id) {
                    if (array_key_exists($relation_id, $fields)) {
                        unset($fields[$relation_id]);
                    }
                }
                
                foreach ($relations as $index => $relation) {
                    $relation_id = $relation_ids[$index] ?? null;
                    if ($item->$relation) {
                        $fields[ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relation_id)))] = $item->$relation->$relation ?? 'N/A';
                    }
                }

                return $fields;
            });

            return response()->json([
                'success' => 'Entry updated successfully',
                'entries' => $data
            ]);
        }

        return response()->json(['error' => 'Entry not found'], 404);
    }

    public function destroy(Request $request, $type, $id)
    {
        

        $modelName = 'App\\Models\\' . ucfirst($type);
        $modelInstance = resolve($modelName);

        if (!class_exists($modelName)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $entry = $modelInstance::find($id);
        if ($entry) {
            $entry->delete();
            // dd($entry);
            return response()->json(['success' => 'Entry deleted successfully']);
        }
        return response()->json(['error' => 'Entry not found'], 404);
    }


}
