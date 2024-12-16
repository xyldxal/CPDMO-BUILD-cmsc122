<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $primaryKey = 'id';

    protected $fillable=[
        'tracking_number',
        'project_title',
        
        'project_description',
        'year',

        'college_unit',
        'main_status',

        'project_in_charge',

        'notice_of_award',
        'notice_to_proceed',
        'additional_days',
        'contract_duration',

        'approved_budget',
        'bid_price_php',

        'revised_contract_amount',
        'original_date_of_completion',

        'remaining_number_of_days',
        'created_by', 
        'updated_by', 
    ];

    // protected $hidden = [
    //     'password',
    // ];

    protected $casts = [
        'year' => 'integer',
        'notice_of_award' => 'date',
        'notice_to_proceed' => 'date',
        'original_date_of_completion' => 'date',
        'additional_days' => 'integer',
        'contract_duration' => 'integer',
        'remaining_number_of_days' => 'integer',
        'approved_budget' => 'double',
        'bid_price_php' => 'double',
        'revised_contract_amount' => 'double',
    ];

    protected $relations=[
        'ovcpdProgressTracker',
        'collegeUnit',
        'mainStatus',
        // 'accomplishment', //skip in bulk
        // 'activity', //skip in bulk
        // 'billing', //skip in bulk
        // 'changeOrder', //skip in bulk
        // 'financialDetail', //skip in bulk
        // 'fundSource', //skip in bulk
        // 'geodata', //skip in bulk
        // 'image', //skip in bulk
        // 'issue', //skip in bulk
        // 'paymentStatus', //skip in bulk
        // 'projectContractor', //skip in bulk
        // 'recentUpdate', //skip in bulk
        // 'status', //skip in bulk
        'createdBy',
        'updatedBy',
    ];

    protected $relation_fields=[
        'tracking_number',
        'shortname',
        'status',
        'email',
        'email',
    ];

    protected $relation_ids=[
        'Tracking Number' => 'tracking_number',
        'Implementing Unit' => 'college_unit',
        'Main Status' => 'main_status',
        'created_by' => 'created_by',
        'updated_by' => 'updated_by',
    ];

    public static function validationRules($id = null)
    {
        return [
                'tracking_number' => 'nullable|exists:ovcpd_tracked_projects,tracking_number',
                'project_title' => 'string|max:720',
                'project_description' => 'string|nullable|max:2000',
                'year' => 'numeric|nullable|max:2099|min:1900',

                'college_unit' => 'required|exists:c_colleges,id',
                'main_status' => 'required|exists:c_main_statuses,id',

                'project_in_charge' => 'string|nullable|max:720',

                'notice_of_award' => 'date|nullable',
                'notice_to_proceed' => 'date|nullable',
                'additional_days' => 'numeric|nullable|max:99999999',
                'contract_duration' => 'numeric|nullable',

                'approved_budget' => 'numeric|nullable',
                'bid_price_php' => 'numeric|nullable',

                'revised_contract_amount' => 'numeric|nullable',
                'original_date_of_completion' => 'date|nullable',

                'remaining_number_of_days' => 'numeric|nullable',
        ];
    }


    public function createdBy()
    {
        return $this->belongsTo(SystemUser::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(SystemUser::class, 'updated_by', 'id');
    }

    public function ovcpdProgressTracker()
    {
        return $this->belongsto(OVCPDProgressTracker::class, 'tracking_number', 'tracking_number');
    }

    public function collegeUnit()
    {
        return $this->belongsto(College::class, 'id', 'college_unit');
    }

    public function mainStatus()
    {
        return $this->belongsto(MainStatus::class, 'id', 'main_status');
    }
    
    public function accomplishment()
    {
        return $this->hasMany(Accomplishment::class, 'id', 'accomplishment_id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'id', 'activity_id');
    }

    public function billing()
    {
        return $this->hasMany(Billing::class, 'id', 'billing_id');
    }

    public function changeOrder()
    {
        return $this->hasMany(ChangeOrder::class, 'id', 'change_order_id');
    }

    public function financialDetail()
    {
        return $this->hasMany(FinancialDetail::class, 'id', 'financial_detail_id');
    }

    public function fundSource()
    {
        return $this->hasMany(FundSource::class, 'id', 'fund_source_id');
    }

    public function geodata()
    {
        return $this->hasMany(Geodata::class, 'id', 'geodata_id');
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'id', 'image_id');
    }

    public function issue()
    {
        return $this->hasMany(Issue::class, 'id', 'issue_id');
    }

    public function paymentStatus()
    {
        return $this->hasMany(PaymentStatus::class, 'id', 'payment_status_id');
    }

    public function projectContractors()
    {
        return $this->hasMany(ProjectContractor::class, 'id', 'project_contractors_id');
    }

    public function recentUpdate()
    {
        return $this->hasMany(RecentUpdate::class, 'id', 'recent_update_id');
    }

    public function status()
    {
        return $this->hasMany(Status::class, 'id', 'status_id');
    }

    public function getRelationsProperty()
    {
        return [$this->relations, $this->relation_ids, $this->relation_fields];
    }
}
