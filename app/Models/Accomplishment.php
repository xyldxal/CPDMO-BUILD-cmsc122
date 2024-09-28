<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomplishment extends Model
{
    use HasFactory;

    protected $table = 'accomplishments';

    protected $primaryKey = 'accomplishment_id';

    protected $fillable=[
        'project_id',
        'accomplishment_percentage',
        'accomplishment',
        'as_of',
        'notes',
        'slippage',
        'slippage_status',
    ];

    protected $casts = [
        'accomplishment_percentage' => 'float',
        'as_of' => 'datetime',
        'slippage' => 'double',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
