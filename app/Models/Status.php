<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    // protected $primaryKey = 'status_id';

    protected $fillable=[
        'project_id',
        'as_of',
        'notes',
        'status',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'as_of' => 'date',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }
}
