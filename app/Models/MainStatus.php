<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainStatus extends Model
{
    use HasFactory;
    protected $table = 'c_main_statuses';
    
    protected $fillable=[
        'id',
        'status',
        'created_by', 
        'updated_by', 
    ];
}
