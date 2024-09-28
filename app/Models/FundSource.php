<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundSource extends Model
{
    use HasFactory;

    protected $table = 'fund_sources';

    protected $primaryKey = 'fund_source_id';

    protected $fillable=[
        'project_id',
        'fund_source',
        'is_funded',
        'notes',
    ];

    protected $casts = [
        'is_funded' => 'boolean',
    ];

    public function project()
    {
            return $this->belongsto(Project::class, 'project_id', 'project_id');
    }
}
