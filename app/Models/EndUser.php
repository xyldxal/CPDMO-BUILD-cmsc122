<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndUser extends Model
{
    use HasFactory;
    protected $table = 'c_end_users';
    
    protected $fillable=[
        'id',
        'shortname',
        'description',
        'created_by', 
        'updated_by', 
    ];
}
