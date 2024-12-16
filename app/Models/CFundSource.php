<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CFundSource extends Model
{
    use HasFactory;
    protected $table = 'c_fund_sources';

    protected $fillable=[
        'id',
        'fund_source',
        'description',
        'created_by', 
        'updated_by', 
    ];
}
