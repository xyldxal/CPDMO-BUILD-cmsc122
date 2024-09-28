<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $primaryKey = 'activity_id';

    protected $fillable=[
        'project_id',
        'suspension_date',
        'resumption_date_resumed',
        'resumption_revised_completion_date',
        'extension_date',
        'extension_duration',
        'revised_contract_duration',
        'reason',
        'end_of_contract_time'
    ];

    protected $casts = [
        'suspension_date' => 'datetime',
        'resumption_date_resumed' => 'datetime',
        'resumption_revised_completion_date' => 'datetime',
        'extension_date' => 'datetime',
        'extension_duration' => 'integer',
        'revised_contract_duration' => 'integer',
        'end_of_contract_time' => 'datetime',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
