<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentUpdate extends Model
{
    use HasFactory;

    protected $table = 'recent_updates';

    protected $primaryKey = 'recent_update_id';

    protected $fillable=[
        'project_id',
        'credits',
        'date',
        'notes',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
