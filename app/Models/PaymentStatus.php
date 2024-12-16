<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'payment_statuses';

    // protected $primaryKey = 'payment_status_id';

    protected $fillable=[
        'project_id',
        'date',
        'notes',
        'status',
        'created_by', 
        'updated_by', 
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id');
    }
}
