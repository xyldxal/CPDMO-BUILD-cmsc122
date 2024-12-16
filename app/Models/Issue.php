<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';

    // protected $primaryKey = 'issue_id';

    protected $fillable=[
        'project_id',
        'issue',
        'is_resolved',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }
}
