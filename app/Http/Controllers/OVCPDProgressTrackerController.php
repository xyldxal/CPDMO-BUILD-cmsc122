<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OVCPDProgressTrackerController extends Controller
{
    public function store(Request $request){

        $validated=$request->validate([ 
            // PRIMARY KEY
            'tracking_number'=>'required|max:255|unique:App\Models\OVCPDProgressTracker',
            
            // PLANNING PHASE
            'requirement_desc' => 'nullable|max:720',
            'complete_submission'=>'nullable|max:720',
            
            // DESIGN PHASE
            'detailed_drawings'=>'nullable|boolean',
            'scope_of_work'=>'nullable|boolean',
            'estimate'=>'nullable|boolean',
            'pert_cpm'=>'nullable|boolean',
            'proj_folder_submission'=>'nullable|date|max:720',
            'ovcpd_endorsement'=>'nullable|date|max:720',
            'budget_clearance'=>'nullable|date|max:720',
            'ovcaf_approval'=>'nullable|date|max:720',
            
            // BAC
            'opening'=>'nullable|date|max:720',
            'bid_eval'=>'nullable|date|max:720',
            'post_qualification'=>'nullable|date|max:720',
            'bidding'=>'nullable|date|max:720',
            
            // PROCUREMENT
            'contract_completion'=>'nullable|date|max:720',
            
            // IMPLEMENTATION PHASE
            'received_proj_folder'=>'nullable|date|max:720',
            'preconstruction_meet'=>'nullable|date|max:720',
            'percentage_complete'=>'nullable|numeric',
            'proj_status'=>'nullable|string|max:720',
            'payment_status'=>'nullable|boolean',
            
            // SPMO
            'par_ics_attachment'=>'nullable|boolean',
            'date_accomplished'=>'nullable|date|max:720',
            
            // ACCEPTANCE
            'contract_end'=>'nullable|date|max:720',
            'completion_cert'=>'nullable|date|max:720',
            'final_bill_submission'=>'nullable|date|max:720',
            'par_ics_attachment_2'=>'nullable|boolean',
            'date_accomplished_2'=>'nullable|date|max:720',
            'payment_status_2'=>'nullable|boolean',
            'final_bill_payment_received'=>'nullable|date|max:720',
            
            // RELEASE OF RETENTION
            'retention_bill_submission'=>'nullable|date|max:720',
            'retention_bill_payment_received'=>'nullable|date|max:720',
        ]);

        OVCPDProgressTracker::create($validated);

        return Redirect::route('/greeting');
    }
}
