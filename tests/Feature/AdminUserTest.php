<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated admin cannot update profit', function () {
    $user = User::factory()->create(['balance' => 100.00]);

    $response = $this->post(route('admin.users.profit', $user), [
        'amount' => 50.00,
        'type' => 'add',
    ]);

    $response->assertRedirect(route('admin.login'));
});

test('unauthenticated admin cannot update capital', function () {
    $user = User::factory()->create(['balance' => 100.00]);

    $response = $this->post(route('admin.users.capital', $user), [
        'amount' => 50.00,
        'type' => 'add',
    ]);

    $response->assertRedirect(route('admin.login'));
});

test('authenticated admin can add profit', function () {
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

test('authenticated admin can subtract profit', function () {
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

test('admin cannot subtract profit more than balance', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 30.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.profit', $user), [
        'amount' => 50.00,
        'type' => 'subtract',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Cannot subtract more than the user\'s current balance.');
    $this->assertEquals(30.00, $user->fresh()->balance);
});

test('authenticated admin can add capital', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 100.00,
        'manual_deposits' => 10.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.capital', $user), [
        'amount' => 50.00,
        'type' => 'add',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Balance: 100 + 50 = 150
    $this->assertEquals(150.00, $user->fresh()->balance);
    // manual_deposits: 10 + 50 = 60
    $this->assertEquals(60.00, $user->fresh()->manual_deposits);
});

test('authenticated admin can subtract capital', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 100.00,
        'manual_deposits' => 50.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.capital', $user), [
        'amount' => 30.00,
        'type' => 'subtract',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Balance: 100 - 30 = 70
    $this->assertEquals(70.00, $user->fresh()->balance);
    // manual_deposits: 50 - 30 = 20
    $this->assertEquals(20.00, $user->fresh()->manual_deposits);
});

test('admin cannot subtract capital more than balance', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::factory()->create([
        'balance' => 20.00,
        'manual_deposits' => 50.00,
    ]);

    $response = $this->actingAs($admin, 'admin')->post(route('admin.users.capital', $user), [
        'amount' => 30.00,
        'type' => 'subtract',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Cannot subtract more than the user\'s current balance.');

    $this->assertEquals(20.00, $user->fresh()->balance);
    $this->assertEquals(50.00, $user->fresh()->manual_deposits);
});
