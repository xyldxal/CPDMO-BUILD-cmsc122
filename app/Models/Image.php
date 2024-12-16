<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image_sources';

    // protected $primaryKey = 'image_id';

    protected $fillable=[
        'project_id',
        'image_source',
        'created_by', 
        'updated_by', 
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }
}
