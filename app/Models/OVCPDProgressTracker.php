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
        'contract_completion',
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
        'proj_folder_submission' => 'datetime',
        'ovcpd_endorsement' => 'datetime',
        'budget_clearance' => 'datetime',
        'ovcaf_approval' => 'datetime',
        'contract_completion' => 'datetime',
        'received_proj_folder' => 'datetime',
        'preconstruction_meet' => 'datetime',
        'date_accomplished' => 'datetime',
        'contract_end' => 'datetime',
        'completion_cert' => 'datetime',
        'final_bill_submission' => 'datetime',
        'date_accomplished_2' => 'datetime',
        'final_bill_payment_received' => 'datetime',
        'retention_bill_submission' => 'datetime',
        'retention_bill_payment_received' => 'datetime',
        'opening' => 'datetime',
        'bid_eval' => 'datetime',
        'post_qualification' => 'datetime',
        'bidding' => 'datetime',
        'proj_folder_submission' => 'datetime',
        'percentage_complete' => 'float',
        'detailed_drawings' => 'boolean',
        'estimate' => 'boolean',
        'pert_cpm' => 'boolean',
        'scope_of_work' => 'boolean',
    ];

    public function project()
    {
        return $this->hasOne(Project::class, 'tracking_number', 'tracking_number');
    }
}
