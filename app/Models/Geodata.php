<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geodata extends Model
{
    use HasFactory;

    protected $table = 'geodata';

    // protected $primaryKey = 'geodata_id';

    protected $fillable=[
        'project_id',
        'longitude',
        'latitude',
        'created_by', 
        'updated_by', 
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }
}
