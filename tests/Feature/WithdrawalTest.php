<?php

use App\Mail\WithdrawalRequestedMail;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('unauthenticated users cannot access withdrawal page', function () {
    $this->get(route('withdrawals.index'))
        ->assertRedirect(route('login'));

    $this->get(route('withdrawals.history'))
        ->assertRedirect(route('login'));
});

test('a user can request a crypto withdrawal successfully', function () {
    Mail::fake();

    $user = User::factory()->create([
        'balance' => 500.00,
    ]);

    $this->actingAs($user);

    $response = $this->post(route('withdrawals.store'), [
        'amount' => 100.00,
        'method' => 'bitcoin',
        'destination' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
    ]);

    $response->assertRedirect(route('withdrawals.history'));
    $response->assertSessionHas('success', 'Withdrawal request submitted successfully.');

    $this->assertDatabaseHas('withdrawals', [
        'user_id' => $user->id,
        'amount' => 100.00,
        'method' => 'bitcoin',
        'destination' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
        'status' => 'pending',
    ]);

    // Verify balance is deducted
    $this->assertEquals(400.00, $user->fresh()->balance);

    Mail::assertSent(WithdrawalRequestedMail::class, function (WithdrawalRequestedMail $mail) use ($user) {
        return $mail->hasTo($user->email) &&
               $mail->withdrawal->method === 'bitcoin' &&
               $mail->withdrawal->amount == 100.00;
    });
});

test('a user can request a bank transfer withdrawal successfully with serialized details', function () {
    Mail::fake();

    $user = User::factory()->create([
        'balance' => 1000.00,
    ]);

    $this->actingAs($user);

    $bankDetails = [
        'amount' => 500.00,
        'method' => 'bank_transfer',
        'bank_name' => 'JPMorgan Chase Bank',
        'account_name' => 'John Doe',
        'account_number' => '123456789',
        'routing_number' => '987654321',
        'bank_address' => '123 Wall Street, NY',
    ];

    $response = $this->post(route('withdrawals.store'), $bankDetails);

    $response->assertRedirect(route('withdrawals.history'));
    $response->assertSessionHas('success', 'Withdrawal request submitted successfully.');

    // Check balance deduction
    $this->assertEquals(500.00, $user->fresh()->balance);

    // Retrieve withdrawal
    $withdrawal = Withdrawal::first();
    $this->assertNotNull($withdrawal);
    $this->assertEquals($user->id, $withdrawal->user_id);
    $this->assertEquals(500.00, $withdrawal->amount);
    $this->assertEquals('bank_transfer', $withdrawal->method);

    // Verify serialized destination column
    $decoded = json_decode($withdrawal->destination, true);
    $this->assertNotNull($decoded);
    $this->assertEquals('JPMorgan Chase Bank', $decoded['bank_name']);
    $this->assertEquals('John Doe', $decoded['account_name']);
    $this->assertEquals('123456789', $decoded['account_number']);
    $this->assertEquals('987654321', $decoded['routing_number']);
    $this->assertEquals('123 Wall Street, NY', $decoded['bank_address']);

    Mail::assertSent(WithdrawalRequestedMail::class, function (WithdrawalRequestedMail $mail) use ($user) {
        return $mail->hasTo($user->email) &&
               $mail->withdrawal->method === 'bank_transfer';
    });
});

test('bank transfer withdrawal requires all mandatory bank fields', function () {
    $user = User::factory()->create([
        'balance' => 500.00,
    ]);

    $this->actingAs($user);

    // Missing bank fields
    $response = $this->post(route('withdrawals.store'), [
        'amount' => 200.00,
        'method' => 'bank_transfer',
        // missing bank details
    ]);

    $response->assertSessionHasErrors(['bank_name', 'account_name', 'account_number', 'routing_number']);
    $this->assertEquals(500.00, $user->fresh()->balance);
});

test('a user cannot withdraw more than their balance', function () {
    $user = User::factory()->create([
        'balance' => 150.00,
    ]);

    $this->actingAs($user);

    $response = $this->post(route('withdrawals.store'), [
        'amount' => 200.00,
        'method' => 'bitcoin',
        'destination' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
    ]);

    $response->assertSessionHas('error', 'Insufficient balance. You do not have enough funds for this withdrawal.');
    $this->assertEquals(150.00, $user->fresh()->balance);
});

test('withdrawal request email renders bank wire details correctly', function () {
    $user = User::factory()->create();
    $withdrawal = Withdrawal::create([
        'user_id' => $user->id,
        'amount' => 350.00,
        'method' => 'bank_transfer',
        'destination' => json_encode([
            'bank_name' => 'Capital One',
            'account_name' => 'Jane Smith',
            'account_number' => '9876543210',
            'routing_number' => '123456789',
            'bank_address' => '456 Main St, VA',
        ]),
        'status' => 'pending',
    ]);

    $mailable = new WithdrawalRequestedMail($withdrawal, $user);

    $mailable->assertSeeInHtml('Withdrawal Request Received');
    $mailable->assertSeeInHtml('Capital One');
    $mailable->assertSeeInHtml('Jane Smith');
    $mailable->assertSeeInHtml('9876543210');
    $mailable->assertSeeInHtml('123456789');
    $mailable->assertSeeInHtml('456 Main St, VA');
});
