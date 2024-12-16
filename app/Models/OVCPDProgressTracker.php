<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OVCPDProgressTracker extends Model
{
    use HasFactory;

    protected $table = 'ovcpd_tracked_projects';


    /**
     *  Primary Key is not an incrementing number. It is predefined by user
     */
    protected $primaryKey = 'tracking_number';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'tracking_number',
        'project_title',
        'project_description',
        'end_user_id',
        'fund_source_id',
        'budget',
        'bid_amount',
        'contractor',

        'requirement_desc',
        'complete_submission',

        'detailed_drawings',
        'scope_of_work',
        'estimate',
        'pert_cpm',
        'proj_folder_submission',
        'ovcpd_endorsement',
        'budget_clearance',
        'ovcaf_approval',

        'opening',
        'bid_eval',
        'post_qualification',
        'bidding',

        'issuance_of_noa',
        'contract_completion',
        'notice_to_proceed',

        'received_proj_folder',
        'preconstruction_meet',
        'percentage_complete',
        'proj_status',
        'payment_status',

        'par_ics_attachment',
        'date_accomplished',

        'contract_end',
        'completion_cert',
        'final_bill_submission',
        'par_ics_attachment_2',
        'date_accomplished_2',
        'payment_status_2',
        'final_bill_payment_received',

        'retention_bill_submission',
        'retention_bill_payment_received',

        'created_by', 
        'updated_by', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'proj_folder_submission' => 'date',
        'ovcpd_endorsement' => 'date',
        'budget_clearance' => 'date',
        'ovcaf_approval' => 'date',

        'issuance_of_noa' => 'date',
        'contract_completion' => 'date',
        'notice_to_proceed' => 'date',

        'received_proj_folder' => 'date',
        'preconstruction_meet' => 'date',

        'date_accomplished' => 'date',

        'contract_end' => 'date',
        'completion_cert' => 'date',
        'final_bill_submission' => 'date',
        'date_accomplished_2' => 'date',
        'final_bill_payment_received' => 'date',

        'retention_bill_submission' => 'date',
        'retention_bill_payment_received' => 'date',

        'opening' => 'date',
        'bid_eval' => 'date',
        'post_qualification' => 'date',
        'bidding' => 'date',

        'proj_folder_submission' => 'date',
        'percentage_complete' => 'float',
        'detailed_drawings' => 'boolean',
        'estimate' => 'boolean',
        'pert_cpm' => 'boolean',
        'scope_of_work' => 'boolean',
        
        'budget' => 'float',
        'bid_amount' => 'float',
    ];

    public static function validationRules($id = null)
    {
        return [
                'tracking_number' => 'required|unique:ovcpd_tracked_projects,tracking_number',
                'project_title' => 'required|string|max:720',
                'project_description' => 'string|nullable|max:2000',
                'end_user_id' => 'nullable|exists:c_end_users,id',
                'fund_source_id' => 'nullable|exists:c_fund_sources,id',
                'budget' => 'nullable|numeric|min:0',
                'bid_amount' => 'nullable|numeric|min:0',
                'contractor' => 'string|nullable|max:1000',

                'requirement_desc' => 'string|nullable|max:2000',
                'complete_submission' => 'nullable|date',
                'proj_folder_submission' => 'nullable|date',
                'ovcpd_endorsement' => 'nullable|date',
                'budget_clearance' => 'nullable|date',
                'ovcaf_approval' => 'nullable|date',
                'opening' => 'nullable|date',
                'bid_eval' => 'nullable|date',
                'post_qualification' => 'nullable|date',
                'bidding' => 'nullable|date',
                'issuance_of_noa' => 'nullable|date',
                'contract_completion' => 'nullable|date',
                'notice_to_proceed' => 'nullable|date',
                'received_proj_folder' => 'nullable|date',
                'preconstruction_meet' => 'nullable|date',
                'date_accomplished' => 'nullable|date',
                'contract_end' => 'nullable|date',
                'completion_cert' => 'nullable|date',
                'final_bill_submission' => 'nullable|date',
                'date_accomplished_2' => 'nullable|date',
                'final_bill_payment_received' => 'nullable|date',
                'retention_bill_submission' => 'nullable|date',
                'retention_bill_payment_received' => 'nullable|date',

                'detailed_drawings' => 'nullable|boolean',
                'scope_of_work' => 'nullable|boolean',
                'estimate' => 'nullable|boolean',
                'pert_cpm' => 'nullable|boolean',
                'par_ics_attachment' => 'nullable|boolean',
                'par_ics_attachment_2' => 'nullable|boolean',

                'proj_status' => 'nullable|string|max:2000',
                'payment_status' => 'nullable|string|max:1000',
                'payment_status_2' => 'nullable|string|max:1000',
                
                'percentage_complete' => 'nullable|numeric|min:0|max:100',
        ];
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'tracking_number', 'tracking_number');
    }

    public function endUser()
    {
        return $this->belongsTo(EndUser::class, 'end_user_id', 'id');
    }

    public function fundSource()
    {
        return $this->belongsTo(CFundSource::class, 'fund_source_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(SystemUser::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(SystemUser::class, 'updated_by', 'id');
    }
}
