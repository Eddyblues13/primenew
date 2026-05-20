<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated admin cannot update profit or capital', function () {
    $user = User::factory()->create(['balance' => 100.00]);

    $response = $this->post(route('admin.users.profit', $user), [
        'amount' => 50.00,
        'type' => 'add',
        'capital_amount' => 20.00,
    ]);

    $response->assertRedirect(route('admin.login'));
});

test('authenticated admin can add profit only', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 100.00,
        'manual_deposits' => 0.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.profit', $user), [
        'amount' => 50.00,
        'type' => 'add',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertEquals(150.00, $user->fresh()->balance);
    $this->assertEquals(0.00, $user->fresh()->manual_deposits);
    $this->assertDatabaseHas('profits', [
        'user_id' => $user->id,
        'amount' => 50.00,
        'type' => 'add',
    ]);
});

test('authenticated admin can add profit and add capital simultaneously', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 100.00,
        'manual_deposits' => 10.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.profit', $user), [
        'amount' => 50.00,
        'type' => 'add',
        'capital_amount' => 30.00,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Balance should be: 100 (initial) + 50 (profit) + 30 (capital) = 180
    $this->assertEquals(180.00, $user->fresh()->balance);
    // manual_deposits should be: 10 (initial) + 30 (capital) = 40
    $this->assertEquals(40.00, $user->fresh()->manual_deposits);
});

test('authenticated admin can subtract profit only', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 100.00,
        'manual_deposits' => 20.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.profit', $user), [
        'amount' => 40.00,
        'type' => 'subtract',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertEquals(60.00, $user->fresh()->balance);
    $this->assertEquals(20.00, $user->fresh()->manual_deposits);
    $this->assertDatabaseHas('profits', [
        'user_id' => $user->id,
        'amount' => 40.00,
        'type' => 'subtract',
    ]);
});

test('authenticated admin can subtract profit and subtract capital simultaneously', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 100.00,
        'manual_deposits' => 50.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.profit', $user), [
        'amount' => 30.00,
        'type' => 'subtract',
        'capital_amount' => 20.00,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Balance: 100 - 30 - 20 = 50
    $this->assertEquals(50.00, $user->fresh()->balance);
    // manual_deposits: 50 - 20 = 30
    $this->assertEquals(30.00, $user->fresh()->manual_deposits);
});

test('admin cannot subtract more than the user\'s current balance', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 50.00,
        'manual_deposits' => 30.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.profit', $user), [
        'amount' => 40.00,
        'type' => 'subtract',
        'capital_amount' => 20.00, // Total subtract = 60.00, which is > 50.00 balance
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Cannot subtract more than the user\'s current balance.');

    // Balance and manual_deposits should remain unchanged
    $this->assertEquals(50.00, $user->fresh()->balance);
    $this->assertEquals(30.00, $user->fresh()->manual_deposits);
});
