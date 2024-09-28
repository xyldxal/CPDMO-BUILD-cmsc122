<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billings';

    protected $primaryKey = 'billing_id';

    protected $fillable=[
        'project_id',
        'total_billings',
        'billing_percentage',
        'billed_variation_orders',
        'awarded',
        'percent_savings',
        'as_of',
        'notes'
    ];

    protected $casts = [
        'billing_percentage' => 'float',
        'percent_savings' => 'float',
        'total_billings' => 'double',
        'billed_variation_orders' => 'double',
        'awarded' => 'double',
        'total_billings' => 'double',
        'as_of' => 'datetime',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
