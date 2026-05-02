<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $fillable = [
        'name', 'type', 'min_amount', 'max_amount', 'roi_percent', 'duration_days'
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
