<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $table = 'c_colleges';
    protected $fillable=[
        'id',
        'shortname',
        'description',
        'created_by', 
        'updated_by', 
    ];
}
