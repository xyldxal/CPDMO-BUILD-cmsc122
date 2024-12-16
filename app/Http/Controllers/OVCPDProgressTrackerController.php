<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OVCPDProgressTracker;
use App\Models\Project;
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

class OVCPDProgressTrackerController extends Controller
{
    public function store(Request $request){

        try{
            $validated=$request->validate([ 
                // PRIMARY KEY
                'tracking_number'=>'required|max:255|unique:App\Models\OVCPDProgressTracker',
                
                // PROJECT DETAILS
                'project_title'=>'nullable|string|max:255',
                'project_description'=>'nullable|string|max:2000',
                'end_user_id' => 'required|exists:c_end_users,id',
                'fund_source_id' => 'required|exists:c_fund_sources,id',
                'budget'=>'nullable|numeric',
                'bid_amount'=>'nullable|numeric',
                'contractor'=>'nullable|string|max:1000',

                // PLANNING PHASE
                'requirement_desc' => 'nullable|max:2000',
                'complete_submission'=>'nullable|max:1000',
                
                // DESIGN PHASE
                'detailed_drawings'=>'nullable|boolean',
                'scope_of_work'=>'nullable|boolean',
                'estimate'=>'nullable|boolean',
                'pert_cpm'=>'nullable|boolean',
                'proj_folder_submission'=>'nullable|date',
                'ovcpd_endorsement'=>'nullable|date',
                'budget_clearance'=>'nullable|date',
                'ovcaf_approval'=>'nullable|date',
                
                // BAC
                'opening'=>'nullable|date',
                'bid_eval'=>'nullable|date',
                'post_qualification'=>'nullable|date',
                'bidding'=>'nullable|date',
                
                // PROCUREMENT
                'issuance_of_noa'=>'nullable|date',
                'contract_completion'=>'nullable|date',
                'notice_to_proceed'=>'nullable|date',
                
                // IMPLEMENTATION PHASE
                'received_proj_folder'=>'nullable|date',
                'preconstruction_meet'=>'nullable|date',
                'percentage_complete'=>'nullable|numeric',
                'proj_status'=>'nullable|string|max:2000',
                'payment_status'=>'nullable|string|max:1000',
                
                // SPMO
                'par_ics_attachment'=>'nullable|boolean',
                'date_accomplished'=>'nullable|date',
                
                // ACCEPTANCE
                'contract_end'=>'nullable|date',
                'completion_cert'=>'nullable|date',
                'final_bill_submission'=>'nullable|date',
                'par_ics_attachment_2'=>'nullable|boolean',
                'date_accomplished_2'=>'nullable|date',
                'payment_status_2'=>'nullable|string|max:1000',
                'final_bill_payment_received'=>'nullable|date',
                
                // RELEASE OF RETENTION
                'retention_bill_submission'=>'nullable|date',
                'retention_bill_payment_received'=>'nullable|date',
            ]);
            $validated['created_by'] = auth()->user()->id;

            OVCPDProgressTracker::create($validated);

            return response()->json(['success' => 'Project Master Plan updated successfully'], 200);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OVCPDProgressTracker  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $modelName = 'App\\Models\\OVCPDProgressTracker';
        $modelInstance = resolve($modelName);
        $entry = is_null($id) 
            ? tap(new $modelInstance)->fill(array_fill_keys($modelInstance->getFillable(), null))
            : $modelInstance::find($id);
        $fields = $entry->getAttributes();

        $FundSource = \App\Models\CFundSource::select('id', 'fund_source')->get();
        $EndUser = \App\Models\EndUser::select('id', 'shortname')->get();

        // $updates = (new ProgressTrackerController())->progressTrackers()->json_raw;
        // dd($updates);
        return response()->json([
            'FundSource' => $FundSource,
            'EndUser' => $EndUser,

            'ProjectTracker' => $entry,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OVCPDProgressTracker  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelName = 'App\\Models\\OVCPDProgressTracker';
        $modelInstance = resolve($modelName);
        $entry = $modelInstance::find($id);

        $request->merge([
            'detailed_drawings' => $request->has('detailed_drawings'),
            'scope_of_work' => $request->has('scope_of_work'),
            'estimate' => $request->has('estimate'),
            'pert_cpm' => $request->has('pert_cpm'),
            'par_ics_attachment' => $request->has('par_ics_attachment'),
            'par_ics_attachment_2' => $request->has('par_ics_attachment_2'),
        ]);

        if($entry){
            $validated=$request->validate([ 
                // PRIMARY KEY
                // 'tracking_number'=>'required|max:255|unique:App\Models\OVCPDProgressTracker',
                
                // PROJECT DETAILS
                'project_title'=>'nullable|string|max:255',
                'project_description'=>'nullable|string|max:2000',
                'end_user_id' => 'required|exists:c_end_users,id',
                'fund_source_id' => 'required|exists:c_fund_sources,id',
                'budget'=>'nullable|numeric',
                'bid_amount'=>'nullable|numeric',
                'contractor'=>'nullable|string|max:1000',

                // PLANNING PHASE
                'requirement_desc' => 'nullable|max:2000',
                'complete_submission'=>'nullable|max:1000',
                
                // DESIGN PHASE
                'detailed_drawings'=>'nullable|boolean',
                'scope_of_work'=>'nullable|boolean',
                'estimate'=>'nullable|boolean',
                'pert_cpm'=>'nullable|boolean',
                'proj_folder_submission'=>'nullable|date',
                'ovcpd_endorsement'=>'nullable|date',
                'budget_clearance'=>'nullable|date',
                'ovcaf_approval'=>'nullable|date',
                
                // BAC
                'opening'=>'nullable|date',
                'bid_eval'=>'nullable|date',
                'post_qualification'=>'nullable|date',
                'bidding'=>'nullable|date',
                
                // PROCUREMENT
                'issuance_of_noa'=>'nullable|date',
                'contract_completion'=>'nullable|date',
                'notice_to_proceed'=>'nullable|date',
                
                // IMPLEMENTATION PHASE
                'received_proj_folder'=>'nullable|date',
                'preconstruction_meet'=>'nullable|date',
                'percentage_complete'=>'nullable|numeric|min:0|max:100',
                'proj_status'=>'nullable|string|max:2000',
                'payment_status'=>'nullable|string|max:1000',
                
                // SPMO
                'par_ics_attachment'=>'nullable|boolean',
                'date_accomplished'=>'nullable|date',
                
                // ACCEPTANCE
                'contract_end'=>'nullable|date',
                'completion_cert'=>'nullable|date',
                'final_bill_submission'=>'nullable|date',
                'par_ics_attachment_2'=>'nullable|boolean',
                'date_accomplished_2'=>'nullable|date',
                'payment_status_2'=>'nullable|string|max:1000',
                'final_bill_payment_received'=>'nullable|date',
                
                // RELEASE OF RETENTION
                'retention_bill_submission'=>'nullable|date',
                'retention_bill_payment_received'=>'nullable|date',
            ]);
            
            $validated['updated_by'] = auth()->user()->id;
            $entry->update($validated);
            
            return response()->json(['success' => 'Project Master Plan updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Project Master Plan not found'], 404);
        }
    }

    public function getJson(){
        $projects = OVCPDProgressTracker::all();
        return response()->json($projects);
    }

    public function destroy(Request $request, $id)
    {
        $modelName = 'App\\Models\\OVCPDProgressTracker';
        $modelInstance = resolve($modelName);

        if (!class_exists($modelName)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $entry = $modelInstance::find($id);
        if ($entry) {
            $entry->delete();
            // dd($entry);
            return response()->json(['success' => 'Project Master Plan deleted successfully'], 200);
        }
        return response()->json(['error' => 'Project Master Plan not found'], 404);
    }


    public function bulk(Request $request)
    {
        // Resolve model name dynamically
        $modelName = 'App\\Models\\OVCPDProgressTracker';
        $modelInstance = resolve($modelName);
        
        // dd($request);

        $request->validate([
            'uploaded_file' => 'required|file|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        // dd($request->file('csv_file'));

        $file = $request->file('uploaded_file');

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

        // "tracking_number","project_title","project_description","end_user_id","fund_source_id","budget","bid_amount","contractor","requirement_desc","complete_submission","detailed_drawings","scope_of_work","estimate","pert_cpm","proj_folder_submission","ovcpd_endorsement","budget_clearance","ovcaf_approval","opening","bid_eval","post_qualification","bidding","issuance_of_noa","contract_completion","notice_to_proceed","received_proj_folder","preconstruction_meet","percentage_complete","proj_status","payment_status","par_ics_attachment","date_accomplished","contract_end","completion_cert","final_bill_submission","par_ics_attachment_2","date_accomplished_2","payment_status_2","final_bill_payment_received","retention_bill_submission","retention_bill_payment_received","created_by","updated_by","created_at","updated_at"

        $columns = [
            'TRACKING NUMBER',
            'PROJECT TITLE',
            'END-USER',
            'BUDGET',
            'CONTRACT/BID AMOUNT',
            'BRIEF DESCRIPTION',
            'CONTRACTOR',
            'FUND SOURCE',

            'Description of Requirements',
            'Complete Submission of Design Space Requirements including furniture and equipment (Date)',

            'Detailed Drawings/Plan',
            'Scope of Work/Tech specs',
            'Estimate',
            'PERT-CPM',
            'Project Folder Submission and PR Preparation (Date)',
            'Endorsement (Date)',
            'Clearance (Date)',
            'Approval (Date)',

            'Opening',
            'Bid Evaluation',
            'Post-qualification',
            'Bidding (BAC RESO)',
            'Issuance of Notice of Award (Date)',
            'Completion of Contract for Signing (Date)',
            'Notice to Proceed (Date)',

            'Receipt of Project Folder (Date)',
            'Pre-construction Meeting (Date)',
            'Percentage Completion (%)',
            'Project Status',
            'Payment Status',

            'Attachment of PAR/ICS',
            'Date Accomplished',
            
            'End of Contract Time (Date)',
            'Certificate of Completion (Date)',
            'Final Billing Submission (Date)',

            'Attachment of PAR/ICS',
            'Date Accomplished',
            'Payment Status',
            'Final Billing Payment Received (Date)',
            'Retention Billing Submission (Date)',
            'Retention Billing Payment Received (Date)',
        ];
        $FundSource = \App\Models\CFundSource::select('id', 'fund_source')->get();
        $EndUser = \App\Models\EndUser::select('id', 'shortname')->get();

        // Skip the first three rows (headers)
        $fileData = array_slice($fileData, 3);
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

            // dd($row);

            $data = [
                'tracking_number' => $row[0],
                'project_title' => $row[1],
                'end_user_id' => $row[2] ? ($modelInstance->endUser()->getRelated())::firstOrCreate(['shortname' => $row[2]], ['created_by' => $currentUserId])->id : null, //($modelInstance->endUser()->getRelated())::where('shortname', $row[2])->first()->id ?? NULL,
                'budget' => !empty($row[3]) ? (float) str_replace(',', '', $row[3]) : null,
                'bid_amount' => !empty($row[4]) ? (float) str_replace(',', '', $row[4]) : null,
                'project_description' => $row[5],
                'contractor' => $row[6],
                
                'fund_source_id' => $row[7] ? ($modelInstance->fundSource()->getRelated())::firstOrCreate(['fund_source' => $row[7]], ['created_by' => $currentUserId])->id : null, //($modelInstance->fundSource()->getRelated())::where('fund_source', $row[4])->first()->id ?? NULL,

                'requirement_desc' => $row[8],
                'complete_submission' => $row[9],

                'detailed_drawings' => strtoupper($row[10] ?? false) === 'TRUE',
                'scope_of_work' => strtoupper($row[11] ?? false) === 'TRUE',
                'estimate' => strtoupper($row[12] ?? false) === 'TRUE',
                'pert_cpm' => strtoupper($row[13] ?? false) === 'TRUE',
                'proj_folder_submission' => empty($row[14]) ? null : (is_numeric($row[14]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14])->format('Y-m-d') : date('Y-m-d', strtotime($row[14]))),
                'ovcpd_endorsement' => empty($row[15]) ? null : (is_numeric($row[15]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15])->format('Y-m-d') : date('Y-m-d', strtotime($row[15]))),
                'budget_clearance' => empty($row[16]) ? null : (is_numeric($row[16]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[16])->format('Y-m-d') : date('Y-m-d', strtotime($row[16]))),
                'ovcaf_approval' => empty($row[17]) ? null : (is_numeric($row[17]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[17])->format('Y-m-d') : date('Y-m-d', strtotime($row[17]))),

                'opening' => empty($row[18]) ? null : (is_numeric($row[18]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[18])->format('Y-m-d') : date('Y-m-d', strtotime($row[18]))),
                'bid_eval' => empty($row[19]) ? null : (is_numeric($row[19]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[19])->format('Y-m-d') : date('Y-m-d', strtotime($row[19]))),
                'post_qualification' => empty($row[20]) ? null : (is_numeric($row[20]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[20])->format('Y-m-d') : date('Y-m-d', strtotime($row[20]))),
                'bidding' => empty($row[21]) ? null : (is_numeric($row[21]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('Y-m-d') : date('Y-m-d', strtotime($row[21]))),

                'issuance_of_noa' => empty($row[22]) ? null : (is_numeric($row[22]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[22])->format('Y-m-d') : date('Y-m-d', strtotime($row[22]))),
                'contract_completion' => empty($row[23]) ? null : (is_numeric($row[23]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[23])->format('Y-m-d') : date('Y-m-d', strtotime($row[23]))),
                'notice_to_proceed' => empty($row[24]) ? null : (is_numeric($row[24]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[24])->format('Y-m-d') : date('Y-m-d', strtotime($row[24]))),

                'received_proj_folder' => empty($row[25]) ? null : (is_numeric($row[25]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[25])->format('Y-m-d') : date('Y-m-d', strtotime($row[25]))),
                'preconstruction_meet' => empty($row[26]) ? null : (is_numeric($row[26]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[26])->format('Y-m-d') : date('Y-m-d', strtotime($row[26]))),
                'percentage_complete' => $row[27],
                'proj_status' => $row[28],
                'payment_status' => $row[29],

                'par_ics_attachment' => strtoupper($row[30] ?? false) === 'TRUE',
                'date_accomplished' => empty($row[31]) ? null : (is_numeric($row[31]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[31])->format('Y-m-d') : date('Y-m-d', strtotime($row[31]))),

                'contract_end' => empty($row[32]) ? null : (is_numeric($row[32]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[32])->format('Y-m-d') : date('Y-m-d', strtotime($row[32]))),
                'completion_cert' => empty($row[33]) ? null : (is_numeric($row[33]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[33])->format('Y-m-d') : date('Y-m-d', strtotime($row[33]))),
                'final_bill_submission' => empty($row[34]) ? null : (is_numeric($row[34]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[34])->format('Y-m-d') : date('Y-m-d', strtotime($row[34]))),
                'par_ics_attachment_2' => strtoupper($row[35] ?? false) === 'TRUE',
                'date_accomplished_2' => empty($row[36]) ? null : (is_numeric($row[36]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[36])->format('Y-m-d') : date('Y-m-d', strtotime($row[36]))),
                'payment_status_2' => $row[37],
                'final_bill_payment_received' => empty($row[38]) ? null : (is_numeric($row[38]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[38])->format('Y-m-d') : date('Y-m-d', strtotime($row[38]))),

                'retention_bill_submission' => empty($row[39]) ? null : (is_numeric($row[39]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[39])->format('Y-m-d') : date('Y-m-d', strtotime($row[39]))),
                'retention_bill_payment_received' => empty($row[40]) ? null : (is_numeric($row[40]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[40])->format('Y-m-d') : date('Y-m-d', strtotime($row[40]))),
            ];

            // dd([
            //     'data' => $data,
            //     'row' => $row,
            //     'row 40' => $row[40],
            //     'data 40' => $data['retention_bill_payment_received'],
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
                $currID = $modelInstance->create($data)->tracking_number;
                // echo "<br>DATA: " . $currID;
                $generatedIds[] = $currID;
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

        DB::commit();

        // Return validation results and success message
        return response()->json([
            'reponse_message' => 'Entries processed successfully',
            'validated_rows' => $validatedRows,
            'validation_errors' => $validationErrors,
            'status' => 200,
        ]);
    }
}
