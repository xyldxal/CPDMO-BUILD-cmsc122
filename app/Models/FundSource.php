<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundSource extends Model
{
    use HasFactory;

    protected $table = 'fund_sources';

    protected $fillable=[
        'project_id',
        'fund_source_id',
        'is_funded',
        'notes',
        'created_by', 
        'updated_by', 
    ];

    public static function validationRules($id = null)
    {
        return [
            'project_id' => 'nullable|exists:projects,id',
            'fund_source_id' => 'required|exists:c_fund_sources,id',
            'is_funded' => 'boolean|nullable',
            'notes' => 'string|nullable|max:2000',
            'created_by' => 'required|exists:system_users,id',
            'updated_by' => 'nullable|exists:system_users,id',
        ];
    }

    protected $casts = [
        'is_funded' => 'boolean',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }

    public function fundSource()
    {
            return $this->belongsto(CFundSource::class, 'fund_source_id');
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
