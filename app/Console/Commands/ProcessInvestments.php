<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessInvestments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-investments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process mature investments and credit users with their principal and ROI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $investments = \App\Models\Investment::with('plan', 'user')
            ->where('status', 'active')
            ->get();

        $processedCount = 0;

        foreach ($investments as $investment) {
            $maturityDate = $investment->created_at->addDays($investment->plan->duration_days);

            if (now()->greaterThanOrEqualTo($maturityDate)) {
                // Calculate ROI
                $roiAmount = $investment->amount * ($investment->plan->roi_percent / 100);
                $totalPayout = $investment->amount + $roiAmount;

                // Credit user
                $user = $investment->user;
                $user->balance += $totalPayout;
                $user->save();

                // Mark investment as completed
                $investment->returns_earned = $roiAmount;
                $investment->status = 'completed';
                $investment->save();

                $processedCount++;
            }
        }

        $this->info("Processed {$processedCount} mature investments.");
    }
}
