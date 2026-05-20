<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $fillable = [
        'name', 'type', 'min_amount', 'max_amount', 'roi_percent', 'duration_days',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duration_days' => 'integer',
            'roi_percent' => 'float',
            'min_amount' => 'float',
            'max_amount' => 'float',
        ];
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
