<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\OVCPDProgressTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProgressTrackerController;
use App\Services\JsonFileService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $jsonFileService;

    // Inject the JsonFileService in this controller
    // public function __construct(JsonFileService $jsonFileService)
    // {
    //     $this->jsonFileService = $jsonFileService;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $tracker = OVCPDProgressTracker::findOrFail($trackerId);
        try{
            $validated=$request->validate([ 
                // TRACKING_NUMBER IS REMOVED AND WILL BE INHERITING TRACKING_NUMBER FROM OVCPDPROGRESSTRACKER 
                'tracking_number' => 'nullable|exists:ovcpd_tracked_projects,tracking_number',
                'project_title' => 'string|max:720',
                'project_description' => 'string|nullable|max:2000',
                'year' => 'numeric|nullable|max:2099|min:1900',

                'college_unit' => 'string|nullable|max:128',
                'main_status' => 'string|nullable|max:128',

                'project_in_charge' => 'string|nullable',

                'notice_of_award' => 'date|nullable',
                'notice_to_proceed' => 'date|nullable',
                'additional_days' => 'numeric|nullable|max:99999999',
                'contract_duration' => 'numeric|nullable',

                'approved_budget' => 'numeric|nullable',
                'bid_price_php' => 'numeric|nullable',

                'revised_contract_amount' => 'numeric|nullable',
                'original_date_of_completion' => 'date|nullable',

                'remaining_number_of_days' => 'numeric|nullable',
            ]);
            // $validated['tracking_number'] = $tracker->tracking_number;
            $validated['created_by'] = auth()->user()->id;

            Project::create($validated);
            // dd($validated);

            return response()->json(['success' => 'Project added successfully'], 200);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function bulk(Request $request)
    {
        // Resolve model name dynamically
        $modelName = 'App\\Models\\Project';
        $modelInstance = resolve($modelName);

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        // dd($request->file('csv_file'));

        $file = $request->file('csv_file');

        $extension = $file->getClientOriginalExtension();

        if (in_array($extension, ['csv', 'txt'])) {
            // Handle CSV files
            $fileData = array_map('str_getcsv', file($file->getRealPath()));
        } else if (in_array($extension, ['xlsx', 'xls'])) {
            // Handle Excel files
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $fileData = $worksheet->toArray();
        } else {
            // Handle unsupported file types
            throw new \Exception("Unsupported file type.");
        }

        [$relations, $relationIds, $relationFields] = property_exists($modelInstance, 'relations') ? $modelInstance->getRelationsProperty() : [[], [], []];
        $columns = [
            'Tracking Number', 
            'Project Title', 
            'Project Description', 
            'Year', 
            'Implementing Unit', 
            'Main Status', 
            'Project In Charge', 
            'NOA (Date)', 
            'NTP (Date)', 
            'Additional Days', 
            'Contract Duration', 
            'Approved Budget', 
            'Bid Price (PHP)', 
            'Revised Contract Amount', 
            'Original Date of Completion', 
            'Remaining Number of Days', 
            
            'Fund Source', 
            'Is Funded', 
            'Notes (Fund Source)',
        
            'DAED Contractor', 
            'Construction Contractor', 
            'Construction Manager',
            'Contract Amount',
            'Contractor',
            'Contract Completion Date',

            "Progress",
            "Accomplishment",
            "As Of",
            "Notes",
            "Slippage",
            "Slippage Status",

            "Total Billings",
            "Billing Percentage",
            "Billed Variation Orders",
            "Awarded",
            "% Savings",
            "As Of",
            "Notes",

            "Cost of Completed Works",
            "Cost of Remaining Projects",
            "Liquidated Damages Booked",
            "Total Billed Variation Orders",
            "Notes",
        ];
        $OVCPDProgressTracker = \App\Models\OVCPDProgressTracker::select('tracking_number AS id', 'tracking_number AS tracking_number')->get();
        $FundSource = \App\Models\CFundSource::select('id', 'fund_source')->get();
        $College = \App\Models\College::select('id', 'shortname')->get();
        $EndUser = \App\Models\EndUser::select('id', 'shortname')->get();
        $MainStatus = \App\Models\MainStatus::select('id', 'status')->get();

        // dd([
        //     'fileData' => $fileData,
        //     'extension' => $extension,
        //     'FKs' => $relationIds,
        // ]);

        // Skip the first line (header)
        array_shift($fileData);
        

        // $fillable = $modelInstance->getFillable();
        // $columns = array_diff($fillable, ['created_by', 'updated_by']);

        $currentUserId = auth()->id();
        $generatedIds = [];

        $validationErrors = [];
        $validatedRows = [];

        DB::beginTransaction();

        $rules = $modelInstance::validationRules();

        // dd($modelInstance->collegeUnit());
        
        
        

        foreach ($fileData as $key => $row) {
            $row = array_map('trim', $row);
            if (empty(array_filter(array_diff($row, ['FALSE','TRUE'])))) {
                continue;
            }

            
            if (count($row) !== count($columns)) {
                $validationErrors[] = [
                    'row' => $key + 1,
                    'errors' => ['CSV column count does not match the expected number of columns. Expected: ' . count($columns) . '. Actual: ' . count($row)],
                ];
                continue;
            }

            // $temp = array_combine($columns, $row);
            // $data = $temp;
            // dd($data);
            // dd([
            //     'Filedata' => $fileData,
            //     'row' => $row
            // ]);
            // $college_unit = ($modelInstance->collegeUnit()->getRelated())::where('shortname', $row[4])->first()->id ?? NULL;

            // $main_status = ($modelInstance->mainStatus()->getRelated())::where('status', $row[5])->first()->id ?? NULL;

            $data = [
                'tracking_number' => $row[0],
                'project_title' => $row[1],
                'project_description' => $row[2],
                'year' => $row[3],
                'college_unit' => $row[4] ? ($modelInstance->collegeUnit()->getRelated())::firstOrCreate(['shortname' => $row[4]], ['created_by' => $currentUserId])->id : null,
                'main_status' => $row[5] ? ($modelInstance->mainStatus()->getRelated())::firstOrCreate(['status' => $row[5]], ['created_by' => $currentUserId])->id : null,
                'project_in_charge' => $row[6],
                'notice_of_award' => empty($row[7]) ? null : (is_numeric($row[7]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7])->format('Y-m-d') : date('Y-m-d', strtotime($row[7]))),
                'notice_to_proceed' => empty($row[8]) ? null : (is_numeric($row[8]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('Y-m-d') : date('Y-m-d', strtotime($row[8]))),
                'additional_days' => $row[9],
                'contract_duration' => $row[10],
                'approved_budget' => !empty($row[11]) ? (float) str_replace(',', '', $row[11]) : null,
                'bid_price_php' => !empty($row[12]) ? (float) str_replace(',', '', $row[12]) : null,
                'revised_contract_amount' => !empty($row[13]) ? (float) str_replace(',', '', $row[13]) : null,
                'original_date_of_completion' => is_numeric($row[14]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14])->format('Y-m-d') : date('Y-m-d', strtotime($row[14])),   
                'remaining_number_of_days' => $row[15],
            ];

            // dd([
            //     'data' => $data,
            //     'row' => $row
            // ]);

            //if nullable set value to null if empty string
            foreach ($data as $field => $value) {
                if (isset($rules[$field]) && is_array($rules[$field])){
                    if (in_array('nullable', $rules[$field]) && empty($value)) {
                        $data[$field] = null;
                    }
                } elseif (isset($rules[$field]) && str_contains($rules[$field], 'nullable') && empty($value)) {
                    $data[$field] = null;
                }
            }



            // $foreignKeys = [];

            //ADDITIONAL RELATIONAL FIELD THAT MUST BE INFERRED NOT CREATED
            //STRUCTURE IS: COLNAME => [TABLENAME, MODELNAME, FIELDNAME]
            // $hasOnes = [
            //     'Fund Source' => ['c_fund_sources', 'CFundSource', 'fund_source'],
            //     'Is Funded' => ['c_fund_sources', 'CFundSource', 'is_funded'],
            //     'Notes (Fund Source)' => ['c_fund_sources', 'CFundSource', 'notes'],
            //     // 'Main Status' => ['c_main_statuses', 'MainStatus'],
            // ];

            // $fillables = [
            //     'Project Title' => 'project_title',
            //     'Project Description' => 'project_description',
            //     'Year' => 'year',
            //     'Project In Charge' => 'project_in_charge',
            //     'NOA (Date)' => 'notice_of_award',
            //     'NTP (Date)' => 'notice_to_proceed',
            //     'Additional Days' => 'additional_days',
            //     'Contract Duration' => 'contract_duration',
            //     'Approved Budget' => 'approved_budget',
            //     'Bid Price (PHP)' => 'bid_price_php',
            //     'Revised Contract Amount' => 'revised_contract_amount',
            //     'Original Date of Completion' => 'original_date_of_completion',
            //     'Remaining Number of Days' => 'remaining_number_of_days',
            // ];

            // REPLACING WITH MORE STRAIGHTFORWARD METHOD
            // foreach ($data as $field => $value) {
            //     $relationIndex = array_search($field, array_keys($relationIds));
            //     // $relationIndex = array_search($field, array_keys(array_merge($relationIds, $hasOnes)));
            //     // dd($relationIndex);
            //     // dd([
            //     //     'merged' => array_keys(array_merge($relationIds, $hasOnes)),
            //     //     'relationIds' => $relationIds,
            //     //     'hasOnes' => $hasOnes,
            //     // ]);
            //     if ($relationIndex !== false && $value !== null) {
            //         echo "<br><br><br><br>Relation Index: " . $relationIndex;
            //         echo "<br>count: " . count($relationIds);
                    
            //         // dd($relationIds);
            //         if ($relationIndex < count($relationIds)){
            //             $relationId = $relationIds[$field][1];
            //             $relation = $relations[$relationIndex];
            //             $fieldName = $relationFields[$relationIndex];
            //             $relatedModel = $modelInstance->$relation()->getRelated();
            //         } else {
            //             $relatedModel = resolve('\\App\\Models\\' . $hasOnes[$field][1]); 
            //             $fieldName = $hasOnes[$field][2];
            //             // $relatedModel = $hasOnes[$field][1];
            //             $relationId = $fieldName;
                        
                        
            //             // $modelName = 'App\\Models\\Project';
            //             // $modelInstance = resolve($modelName);
            //         }

            //         // dd($relatedModel);

            //         echo "<br>Field: " . $field;
            //         echo "<br>Field Name: " . $fieldName;
            //         echo "<br>Value: " . $value;
            //         echo "<br>Related Model: " . $relatedModel;
            //         $relatedEntry = $relatedModel::where($fieldName, $value)->first();

            //         if ($relatedEntry) {
            //             unset($data[$field]);
            //             $data[$fieldName] = $relatedEntry->id;
            //         } else {
            //             // If relation lookup fails, log an error for this row
            //             $tempName = ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $fieldName)));
            //             $tempRelationName = ucwords(str_replace('_', ' ', preg_replace('/_id$/i', '', $relationId)));
            //             $validationErrors[] = [
            //                 'row' => $key + 1,
            //                 'errors' => ["{$tempName}: {$value} could not be found. Please check the CSV or the corresponding reference table: {$tempRelationName}."],
            //             ];
            //             continue 2; // Skip this row if relation lookup fails
            //         }  
            //     }
                
    
                // if (!in_array($field, $relationIds) && isset($rules[$field]) && is_array($rules[$field])) {
                //     if (in_array('nullable', $rules[$field]) && empty($value)) {
                //         $data[$field] = null;
                //     }
                // } elseif (!in_array($field, $relationIds) && isset($rules[$field]) && str_contains($rules[$field], 'nullable') && empty($value)) {
                //     $data[$field] = null;
                // }
            // }

            // dd([
            //     'created ID' => $OG,
            //     'data' => $data
            // ]);

            


            // ADD PROJECT DETAILS PART
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
                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }
                $currID = $modelInstance->create($data)->id;
                // echo "<br>DATA: " . $currID;
                $generatedIds[] = $currID;

                //INSERT DATA INTO ASSOCIATED TABLES HERE
                $this->addFundSource($currID, $key, $row, $validationErrors, $data, $currentUserId);
                $this->addContractor($currID, $key, $row, $validationErrors, $data, $currentUserId);
                $this->addAccomplishment($currID, $key, $row, $validationErrors, $data, $currentUserId);
                $this->addBilling($currID, $key, $row, $validationErrors, $data, $currentUserId);
                $this->addFinancialDetails($currID, $key, $row, $validationErrors, $data, $currentUserId);
                $validatedRows[] = $data;


            }
        }

        // dd([
        //     'validatedRows' => $validatedRows,
        //     'validationErrors' => $validationErrors,
        //     'generatedIds' => $generatedIds,
        // ]);

        if (!empty($validationErrors)) {
            DB::rollBack();
            return response()->json([
                'reponse_message' => 'Entries processed with the following error(s):',
                'errors' => $validationErrors,
                'status' => 'error',
            ]);
        } else if (empty($validatedRows)) {
            DB::rollBack();
            return response()->json([
                'reponse_message' => 'All rows are empty. Please check the file being uploaded again.',
                'status' => 'error',
            ]);
        }
        // try{
        //     $bulkUploadHistory = \App\Models\BulkHistory::create([
        //         'filename' => $filename,
        //         'model' => $type,
        //         'generated_ids' => JSON_encode($generatedIds),
        //         'created_by' => $currentUserId,
        //     ]);
        // } catch (\Exception $e) {
        //     $validationErrors[] = "Failed to create bulk upload history: {$e->getMessage()}";
        // }

        DB::commit();

        // Return validation results and success message
        return response()->json([
            'reponse_message' => 'Entries processed successfully',
            'validated_rows' => $validatedRows,
            'validation_errors' => $validationErrors,
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $modelName = 'App\\Models\\Project';
        $modelInstance = resolve($modelName);
        $entry = is_null($id) 
            ? tap(new $modelInstance)->fill(array_fill_keys($modelInstance->getFillable(), null))
            : $modelInstance::find($id);
        $fields = $entry->getAttributes();

        $OVCPDProgressTracker = \App\Models\OVCPDProgressTracker::select('tracking_number AS id', 'tracking_number AS tracking_number')->get();
        $CFundSource = \App\Models\CFundSource::select('id', 'fund_source')->get();
        $College = \App\Models\College::select('id', 'shortname')->get();
        $EndUser = \App\Models\EndUser::select('id', 'shortname')->get();
        $MainStatus = \App\Models\MainStatus::select('id', 'status')->get();

        if(!is_null($id)) {
            $Accomplishment = \App\Models\Accomplishment::where('project_id', $id)->first();
            $Billing = \App\Models\Billing::where('project_id', $id)->first();
            $FinancialDetail = \App\Models\FinancialDetail::where('project_id', $id)->first();
            $FundSource = \App\Models\FundSource::where('project_id', $id)->first();
            $ProjectContractor = \App\Models\ProjectContractor::where('project_id', $id)->first();
            // $MainStatus = \App\Models\MainStatus::where('project_id', $id)->get();
        }

        // dd([
        //     'Accomplishment' => $Accomplishment,
        //     'Billing' => $Billing,
        //     'FinancialDetail' => $FinancialDetail,
        //     'FundSource' => $FundSource,
        //     'ProjectContractor' => $ProjectContractor,
        //     'OVCPDProgressTracker' => $OVCPDProgressTracker,
        //     'CFundSource' => $CFundSource,
        //     'College' => $College,
        //     'EndUser' => $EndUser,
        // ]);

        // $updates = (new ProgressTrackerController())->progressTrackers()->json_raw;
        // dd($updates);
        if (is_null($id)) {
            return response()->json([
                'TrackingNumbers' => $OVCPDProgressTracker,
                'CFundSource' => $CFundSource,
                'College' => $College,
                'EndUser' => $EndUser,
                'MainStatus' => $MainStatus,
                'Project' => $entry,
            ]);
        } else {
            return response()->json([
                'TrackingNumbers' => $OVCPDProgressTracker,
                'CFundSource' => $CFundSource,
                'College' => $College,
                'EndUser' => $EndUser,
                'MainStatus' => $MainStatus,
                'Project' => $entry,
                'Accomplishment' => $Accomplishment,
                'Billing' => $Billing,
                'FinancialDetail' => $FinancialDetail,
                'FundSource' => $FundSource,
                'ProjectContractor' => $ProjectContractor,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, JsonFileService $jsonFileService)
    {
        $project = $request->all();
        $tracker = OVCPDProgressTracker::findOrFail($request->tracking_number);
        $modelName = 'App\\Models\\Project';
        $modelInstance = resolve($modelName);
        $rules = $modelInstance::validationRules();
        $entry = $modelInstance::find($id);
        $currentUserId = auth()->id();
        $generatedIds = [];

        $validationErrors = [];
        $validatedRows = [];
        // dd([
        //     'raw' => $project['notice_of_award'],
        //     'is numeric' => is_numeric($project['notice_of_award']),
        //     // 'formatted' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($project['notice_of_award'])->format('Y-m-d'),
        // ]);

        $data = [
            'tracking_number' => $project['tracking_number'],
            'project_title' => $project['project_title'],
            'project_description' => $project['project_description'],
            'year' => $project['year'],
            'college_unit' => $project['college_unit'],
            'main_status' => $project['main_status'],
            'project_in_charge' => $project['project_in_charge'],
            'notice_of_award' => empty($project['notice_of_award']) ? null : (is_numeric($project['notice_of_award']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($project['notice_of_award'])->format('Y-m-d') : date('Y-m-d', strtotime($project['notice_of_award']))),
            'notice_to_proceed' => empty($project['notice_to_proceed']) ? null : (is_numeric($project['notice_to_proceed']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($project['notice_to_proceed'])->format('Y-m-d') : date('Y-m-d', strtotime($project['notice_to_proceed']))),
            'additional_days' => $project['additional_days'],
            'contract_duration' => $project['contract_duration'],
            'approved_budget' => $project['approved_budget'],
            'bid_price_php' => $project['bid_price_php'],
            'revised_contract_amount' => $project['revised_contract_amount'],
            'original_date_of_completion' => empty($project['original_date_of_completion']) ? null : (is_numeric($project['original_date_of_completion']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($project['original_date_of_completion'])->format('Y-m-d') : date('Y-m-d', strtotime($project['original_date_of_completion']))),   
            'remaining_number_of_days' => $project['remaining_number_of_days'],
        ];

        foreach ($project as $field => $value) {
            if (isset($rules[$field]) && is_array($rules[$field])){
                if (in_array('nullable', $rules[$field]) && empty($value)) {
                    $data[$field] = null;
                }
            } elseif (isset($rules[$field]) && str_contains($rules[$field], 'nullable') && empty($value)) {
                $data[$field] = null;
            }
        }

        $data['created_by'] = $currentUserId;
        $data['updated_by'] = null;

        DB::beginTransaction();

        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            $validationErrors[] = [
                'row' => 1,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $entry->update($data);
            $currID = $project['project_id'];
            $generatedIds[] = $currID;

            //INSERT DATA INTO ASSOCIATED TABLES HERE
            $this->addFundSource($currID, null, $project, $validationErrors, $data, $currentUserId);
            $this->addContractor($currID, null, $project, $validationErrors, $data, $currentUserId);
            $this->addAccomplishment($currID, null, $project, $validationErrors, $data, $currentUserId);
            $this->addBilling($currID, null, $project, $validationErrors, $data, $currentUserId);
            $this->addFinancialDetails($currID, null, $project, $validationErrors, $data, $currentUserId);
            $validatedRows[] = $data;


        }
        
        if (!empty($validationErrors)) {
            DB::rollBack();
            return response()->json([
                'reponse_message' => 'Entries processed with the following error(s):',
                'validation_errors' => $validationErrors,
                'status' => 'error',
            ]);
        }

        DB::commit();
        // dd($validatedRows);

        // Return validation results and success message
        return response()->json([
            'reponse_message' => 'Entries processed successfully',
            'validated_rows' => $validatedRows,
            'errors' => $validationErrors,
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $modelName = 'App\\Models\\Project';
        $modelInstance = resolve($modelName);

        if (!class_exists($modelName)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $entry = $modelInstance::find($id);
        if ($entry) {
            $entry->delete();
            // dd($entry);
            return response()->json(['success' => 'Project deleted successfully'], 200);
        }
        return response()->json(['error' => 'Project not found'], 404);
    }

    /**
     * Adds a new fund source entry for a given project.
     *
     * @param int $currID The ID of the current project to associate with the fund source.
     *
     * This method creates a new fund source record using the data provided in the `$row` array.
     * It validates the data against the rules defined in the FundSource model. If validation
     * passes, a new FundSource entry is created in the database. If validation fails, the errors
     * are collected in the `$validationErrors` array.
     */
    private function addFundSource($currID, $key = null, $row, &$validationErrors, &$data, $currentUserId)
    {
        // dd([
        //     'Key' => $key,
        //     'Row' => $row,
        //     'Row Value' => $row['is_funded'],
        //     // 'Raw Value' => $row[16],
        //     'FORMATTED' => strtoupper($key !== null ? $row[17] : ($row['is_funded'] ?? false)) === 'TRUE',
        //     'TEST' => $key !== null ? $row[17] : ($row['fund_source_id'] ?? false),
        // ]);
        $newFundSource = [
            'project_id' => $currID,
            'fund_source_id' => $key !== null ? ($row[16] ? \App\Models\CFundSource::firstOrCreate(['fund_source' => $row[16]], ['created_by' => $currentUserId])->id : null) : $row['fund_source_id'],
            'is_funded' => strtoupper($key !== null ? $row[17] : ($row['is_funded'] ?? false)) === 'TRUE',
            'notes' => $key !== null ? $row[18] : $row['fund_source_notes'],
            'created_by' => $currentUserId,
            'updated_by' => null,
        ];
        
        // echo "<br>FUND SOURCE ID: " . $newFundSource['fund_source_id'];
        $rules = \App\Models\FundSource::validationRules();
        $validator = Validator::make($newFundSource, $rules);
        if ($validator->fails()) {
            $validationErrors[] = [
                'row' => $key !== null ? $key : 0,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            // $validatedRows[] = $data
            $data['fund_source'] = $newFundSource;
            // \App\Models\FundSource::create($newFundSource);
            \App\Models\FundSource::updateOrCreate(['project_id' => $currID],$newFundSource);
        }
    }

    private function addContractor($currID, $key = null, $row, &$validationErrors, &$data, $currentUserId)
    {
        $newContractor = [
            'project_id' => $currID,
            'daed_contractor' => $key !== null ? $row[19] : $row['daed_contractor'],
            'construction_contractor' => $key !== null ? $row[20] : $row['construction_contractor'],
            'construction_manager' => $key !== null ? $row[21] : $row['construction_manager'],
            'contract_amount' => ($value = ($key === null ? $row['contract_amount'] : $row[22])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'contractor' => $key !== null ? $row[23] : $row['contractor'],
            'contract_completion_date' => empty($key !== null ? $row[24] : $row['contract_completion_date']) ? null : (is_numeric($key !== null ? $row[24] : $row['contract_completion_date']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($key !== null ? $row[24] : $row['contract_completion_date'])->format('Y-m-d') : date('Y-m-d', strtotime($key !== null ? $row[24] : $row['contract_completion_date']))),
            'created_by' => $currentUserId,
            'updated_by' => null,
        ];
        
        $rules = \App\Models\ProjectContractor::validationRules();
        $validator = Validator::make($newContractor, $rules);
        if ($validator->fails()) {
            $validationErrors[] = [
                'row' => $key !== null ? $key : 0,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            // $validatedRows[] = $data
            $data['contractor'] = $newContractor;
            // \App\Models\ProjectContractor::create($newContractor);
            $test = \App\Models\ProjectContractor::updateOrCreate(['project_id' => $currID],$newContractor);
            // dd([
            //     'test' => $test,
            //     'is_new' => $test->wasRecentlyCreated,
            // ]);
        }
    }

    private function addAccomplishment($currID, $key = null, $row, &$validationErrors, &$data, $currentUserId)
    {
        $newAccomplishment = [
            'project_id' => $currID,
            'progress' => ($value = ($key === null ? $row['progress'] : $row[25])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,//($key !== null ? ($row[25] ?? null) : ($row['progress'] ?? null)) ?: null,//!empty($row[$key !== null ? $row[25] : $row['progress']]) ? (float) str_replace(',', '', $row[$key !== null ? $row[25] : $row['progress']]) : null,
            'accomplishment' => $key !== null ? $row[26] : $row['accomplishments'],
            'as_of' => empty($key !== null ? $row[27] : $row['accomplishment_as_of']) ? null : (is_numeric($key !== null ? $row[27] : $row['accomplishment_as_of']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($key !== null ? $row[27] : $row['accomplishment_as_of'])->format('Y-m-d') : date('Y-m-d', strtotime($key !== null ? $row[27] : $row['accomplishment_as_of']))),
            'notes' => $key !== null ? $row[28] : $row['accomplishment_notes'],
            // 'slippage' => $key !== null ? $row[29] : $row['total_billings'],
            // 'slippage_status' => $key !== null ? $row[30] : $row['total_billings'],
            'created_by' => $currentUserId,
            'updated_by' => null,
        ];

        // echo "PROGRESS: " . $newAccomplishment['progress'] . "<br>";
        
        // echo "<br>FUND SOURCE ID: " . $newFundSource['fund_source_id'];
        $rules = \App\Models\Accomplishment::validationRules();
        $validator = Validator::make($newAccomplishment, $rules);
        if ($validator->fails()) {
            $validationErrors[] = [
                'row' => $key !== null ? $key : 0,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            // $validatedRows[] = $data
            $data['accomplishment'] = $newAccomplishment;
            // \App\Models\Accomplishment::create($newAccomplishment);
            \App\Models\Accomplishment::updateOrCreate(['project_id' => $currID],$newAccomplishment);
        }
    }

    private function addBilling($currID, $key = null, $row, &$validationErrors, &$data, $currentUserId)
    {
        // dd([
        //     'formatted' => empty($key !== null ? $row[36] : $row['billing_as_of']) ? null : (is_numeric($key !== null ? $row[36] : $row['billing_as_of']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($key !== null ? $row[36] : $row['billing_as_of'])->format('Y-m-d') : date('Y-m-d', strtotime($key !== null ? $row[36] : $row['billing_as_of'],))),
        // ]);
        $addNewBilling = [
            'project_id' => $currID,
            'total_billings' => ($value = ($key === null ? $row['total_billings'] : $row[31])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'billing_percentage' => ($value = ($key === null ? $row['billing_percentage'] : $row[32])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'billed_variation_orders' => ($value = ($key === null ? $row['billed_variation_orders'] : $row[33])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'awarded' => ($value = ($key === null ? $row['awarded'] : $row[34])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'percent_savings' => ($value = ($key === null ? $row['percent_savings'] : $row[35])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,//$key !== null ? $row[35] : $row['percent_savings'],
            'as_of' => empty($key !== null ? $row[36] : $row['billing_as_of']) ? null : (is_numeric($key !== null ? $row[36] : $row['billing_as_of']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($key !== null ? $row[36] : $row['billing_as_of'])->format('Y-m-d') : date('Y-m-d', strtotime($key !== null ? $row[36] : $row['billing_as_of'],))),
            'notes' => $key !== null ? $row[37] : $row['billing_notes'],
            'created_by' => $currentUserId,
            'updated_by' => null,
        ];
        
        // echo "<br>FUND SOURCE ID: " . $newFundSource['fund_source_id'];
        $rules = \App\Models\Billing::validationRules();
        $validator = Validator::make($addNewBilling, $rules);
        if ($validator->fails()) {
            $validationErrors[] = [
                'row' => $key !== null ? $key : 0,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            // $validatedRows[] = $data
            $data['billing'] = $addNewBilling;
            // \App\Models\Billing::create($addNewBilling);
            \App\Models\Billing::updateOrCreate(['project_id' => $currID],$addNewBilling);
        }
    }

    private function addFinancialDetails($currID, $key = null, $row, &$validationErrors, &$data, $currentUserId)
    {
        $addFinancialDetails = [
            'project_id' => $currID,
            'cost_of_completed_works' => ($value = ($key === null ? $row['cost_of_completed_works'] : $row[38])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'cost_of_remaining_projects' => ($value = ($key === null ? $row['cost_of_remaining_projects'] : $row[39])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'liquidated_damages_booked' => ($value = ($key === null ? $row['liquidated_damages_booked'] : $row[40])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'total_billed_variation_orders' => ($value = ($key === null ? $row['total_billed_variation_orders'] : $row[41])) !== '' && $value !== null ? (float) str_replace(',', '', $value) : null,
            'notes' => $key !== null ? $row[42] : $row['financing_notes'],
            'created_by' => $currentUserId,
            'updated_by' => null,
        ];
        
        // echo "<br>FUND SOURCE ID: " . $newFundSource['fund_source_id'];
        $rules = \App\Models\FinancialDetail::validationRules();
        $validator = Validator::make($addFinancialDetails, $rules);
        if ($validator->fails()) {
            $validationErrors[] = [
                'row' => $key !== null ? $key : 0,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            // $validatedRows[] = $data
            // $data['financial_details'] = $addFinancialDetails;
            \App\Models\FinancialDetail::updateOrCreate(['project_id' => $currID],$addFinancialDetails);
        }
    }
}
