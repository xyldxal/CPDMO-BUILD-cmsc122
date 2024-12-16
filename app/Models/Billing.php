<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billings';

    // protected $primaryKey = 'billing_id';

    protected $fillable=[
        'project_id',
        'total_billings',
        'billing_percentage',
        'billed_variation_orders',
        'awarded',
        'percent_savings',
        'as_of',
        'notes',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'billing_percentage' => 'float',
        'percent_savings' => 'float',
        'total_billings' => 'double',
        'billed_variation_orders' => 'double',
        'awarded' => 'double',
        'percent_savings' => 'double',
        'as_of' => 'date',
    ];

    public static function validationRules($id = null)
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'total_billings' => 'nullable|numeric',
            'billing_percentage' => 'nullable|numeric|between:0,100',
            'billed_variation_orders' => 'nullable|numeric',
            'awarded' => 'nullable|numeric',
            'percent_savings' => 'nullable|numeric|between:0,100',
            'as_of' => 'nullable|date',
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
