<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContractor extends Model
{
    use HasFactory;

    protected $table = 'project_contractors';

    protected $primaryKey = 'project_contractors_id';

    protected $fillable=[
        'project_id',
        'daed_contractor',
        'construction_contractor',
        'construction_manager',
        'contract_amount',
        'contractor',
        'contract_completion_date',
    ];

    protected $casts = [
        'contractor_completion_date' => 'datetime',
        'contract_amount' => 'double',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
