<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContractor extends Model
{
    use HasFactory;

    protected $table = 'project_contractors';

    // protected $primaryKey = 'project_contractors_id';

    protected $fillable=[
        'project_id',
        'daed_contractor',
        'construction_contractor',
        'construction_manager',
        'contract_amount',
        'contractor',
        'contract_completion_date',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'contractor_completion_date' => 'date',
        'contract_amount' => 'double',
    ];
    
    public static function validationRules($id = null)
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'daed_contractor' => 'nullable|string|max:500',
            'construction_contractor' => 'nullable|string|max:500',
            'construction_manager' => 'nullable|string|max:500',
            'contract_amount' => 'nullable|numeric',
            'contractor' => 'nullable|string|max:500',
            'contract_completion_date' => 'nullable|date',
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
