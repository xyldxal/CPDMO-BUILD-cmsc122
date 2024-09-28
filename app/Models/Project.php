<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $primaryKey = 'project_id';

    protected $fillable=[
        'tracking_number',
        'project_title',
        
        'project_description',

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
    ];

    // protected $hidden = [
    //     'password',
    // ];

    protected $casts = [
        'notice_of_award' => 'datetime',
        'notice_to_proceed' => 'datetime',
        'original_date_of_completion' => 'datetime',
        'additional_days' => 'integer',
        'contract_duration' => 'integer',
        'remaining_number_of_days' => 'integer',
        'approved_budget' => 'double',
        'bid_price_php' => 'double',
        'revised_contract_amount' => 'double',
    ];

    public function ovcpdProgressTracker()
    {
        return $this->belongsto(OVCPDProgressTracker::class, 'tracking_number', 'tracking_number');
    }
    
    public function accomplishment()
    {
        return $this->hasMany(Accomplishment::class, 'project_id', 'accomplishment_id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'project_id', 'activity_id');
    }

    public function billing()
    {
        return $this->hasMany(Billing::class, 'project_id', 'billing_id');
    }

    public function changeOrder()
    {
        return $this->hasMany(ChangeOrder::class, 'project_id', 'change_order_id');
    }

    public function financialDetail()
    {
        return $this->hasMany(FinancialDetail::class, 'project_id', 'financial_detail_id');
    }

    public function fundSource()
    {
        return $this->hasMany(FundSource::class, 'project_id', 'fund_source_id');
    }

    public function geodata()
    {
        return $this->hasMany(Geodata::class, 'project_id', 'geodata_id');
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'project_id', 'image_id');
    }

    public function issue()
    {
        return $this->hasMany(Issue::class, 'project_id', 'issue_id');
    }

    public function paymentStatus()
    {
        return $this->hasMany(PaymentStatus::class, 'project_id', 'payment_status_id');
    }

    public function projectContractors()
    {
        return $this->hasMany(ProjectContractor::class, 'project_id', 'project_contractors_id');
    }

    public function recentUpdate()
    {
        return $this->hasMany(RecentUpdate::class, 'project_id', 'recent_update_id');
    }

    public function status()
    {
        return $this->hasMany(Status::class, 'project_id', 'status_id');
    }
}
