<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDetail extends Model
{
    use HasFactory;

    protected $table = 'financial_details';

    // protected $primaryKey = 'financial_detail_id';

    protected $fillable=[
        'project_id',
        'cost_of_completed_works',
        'cost_of_remaining_projects',
        'liquidated_damages_booked',
        'total_billed_variation_orders',
        'notes',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'cost_of_completed_works' => 'double',
        'cost_of_remaining_projects' => 'double',
        'liquidated_damages_booked' => 'double',
        'total_billed_variation_orders' => 'double',
        
    ];

    public static function validationRules($id = null)
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'cost_of_completed_works' => 'nullable|numeric',
            'cost_of_remaining_projects' => 'nullable|numeric',
            'liquidated_damages_booked' => 'nullable|numeric',
            'total_billed_variation_orders' => 'nullable|numeric',
            'notes' => 'nullable|string|max:2000',
            'created_by' => 'required|exists:system_users,id',
            'updated_by' => 'nullable|exists:system_users,id',
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

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }
}
