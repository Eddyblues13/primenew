<?php

use App\Models\Investment;
use App\Models\InvestmentPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated users cannot access investment history page', function () {
    $this->get(route('investments.history'))
        ->assertRedirect(route('login'));
});

test('authenticated users can access investment history page and see their investments', function () {
    $user = User::factory()->create();

    $plan = InvestmentPlan::create([
        'name' => 'Tesla Premium',
        'type' => 'tesla',
        'min_amount' => 1000.00,
        'max_amount' => 5000.00,
        'roi_percent' => 15.5,
        'duration_days' => 30, // Passed as integer
    ]);

    $investment = Investment::create([
        'user_id' => $user->id,
        'investment_plan_id' => $plan->id,
        'amount' => 2000.00,
        'status' => 'active',
    ]);

    $this->actingAs($user);

    $response = $this->get(route('investments.history'));

    $response->assertStatus(200);
    $response->assertSee('Tesla Premium');
    $response->assertSee('Tesla Premium');
    $response->assertSee('$2,000.00');
    $response->assertSee('+15.5%');
});

test('duration_days is cast to integer in the model, allowing carbon arithmetic to succeed', function () {
    $plan = InvestmentPlan::create([
        'name' => 'Crypto Basic',
        'type' => 'crypto',
        'min_amount' => 100.00,
        'max_amount' => 1000.00,
        'roi_percent' => 5.0,
        'duration_days' => '45', // Stored as a string to simulate raw DB state
    ]);

    // Retrieve from DB to check if cast was successful
    $freshPlan = InvestmentPlan::find($plan->id);

    $this->assertIsInt($freshPlan->duration_days);
    $this->assertEquals(45, $freshPlan->duration_days);

    // Verify Carbon can perform addDays with it without throwing a TypeError
    $date = now();
    $futureDate = $date->copy()->addDays($freshPlan->duration_days);
    $this->assertTrue($futureDate->isAfter($date));
});
