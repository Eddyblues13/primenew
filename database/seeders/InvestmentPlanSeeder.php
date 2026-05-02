<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\InvestmentPlan;

class InvestmentPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            // Tesla Plans
            ['name' => 'EV Starter', 'type' => 'tesla', 'min_amount' => 500, 'max_amount' => 4999, 'roi_percent' => 5.5, 'duration_days' => 7],
            ['name' => 'Autonomous Pro', 'type' => 'tesla', 'min_amount' => 5000, 'max_amount' => 19999, 'roi_percent' => 12.0, 'duration_days' => 14],
            ['name' => 'Gigafactory Elite', 'type' => 'tesla', 'min_amount' => 20000, 'max_amount' => 100000, 'roi_percent' => 25.0, 'duration_days' => 30],
            
            // Crypto Plans
            ['name' => 'DeFi Bronze', 'type' => 'crypto', 'min_amount' => 100, 'max_amount' => 999, 'roi_percent' => 3.5, 'duration_days' => 5],
            ['name' => 'Web3 Silver', 'type' => 'crypto', 'min_amount' => 1000, 'max_amount' => 9999, 'roi_percent' => 10.0, 'duration_days' => 15],
            ['name' => 'Metaverse Gold', 'type' => 'crypto', 'min_amount' => 10000, 'max_amount' => 50000, 'roi_percent' => 30.0, 'duration_days' => 45],
        ];

        foreach ($plans as $plan) {
            InvestmentPlan::create($plan);
        }
    }
}
