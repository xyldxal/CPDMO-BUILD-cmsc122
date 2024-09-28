<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDetail extends Model
{
    use HasFactory;

    protected $table = 'financial_details';

    protected $primaryKey = 'financial_detail_id';

    protected $fillable=[
        'project_id',
        'cost_of_completed_works',
        'cost_of_remaining_projects',
        'liquidated_damages_booked',
        'total_billed_variation_orders',
        'notes',
    ];

    protected $casts = [
        'cost_of_completed_works' => 'double',
        'cost_of_remaining_projects' => 'double',
        'liquidated_damages_booked' => 'double',
        'total_billed_variation_orders' => 'double',
        
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
