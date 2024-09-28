<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeOrder extends Model
{
    use HasFactory;

    protected $table = 'change_orders';

    protected $primaryKey = 'change_order_id';

    protected $fillable=[
        'project_id',
        'change_order_number',
        'amount',
        'notes',
    ];

    protected $casts = [
        'change_order_number' => 'integer',
        'amount' => 'double',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
