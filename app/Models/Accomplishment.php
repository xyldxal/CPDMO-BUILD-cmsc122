<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomplishment extends Model
{
    use HasFactory;

    protected $table = 'accomplishments';

    // protected $primaryKey = 'accomplishment_id';

    protected $fillable=[
        'project_id',
        'progress',
        'accomplishment',
        'as_of',
        'notes',
        'slippage',
        'slippage_status',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'progress' => 'decimal:2',
        'as_of' => 'date',
        'slippage' => 'double',
    ];

    public static function validationRules($id = null)
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'progress' => 'nullable|numeric|between:0,100',
            'accomplishment' => 'nullable|string|max:500',
            'as_of' => 'nullable|date',
            'notes' => 'nullable|string|max:2000',
            'slippage' => 'nullable|numeric',
            'slippage_status' => 'nullable|string|max:500',
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
