<?php

use App\Mail\WelcomeUserMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('a user can register and receives a welcome email with credentials', function () {
    Mail::fake();

    $userData = [
        'name' => 'John Doe',
        'username' => 'johndoe',
        'email' => 'johndoe@example.com',
        'country' => 'United States',
        'phone' => '1234567890',
        'password' => 'SecurePassword123!',
        'password_confirmation' => 'SecurePassword123!',
    ];

    $response = $this->post('/register', $userData);

    $response->assertRedirect('/user/dashboard');

    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
        'username' => 'johndoe',
    ]);

    Mail::assertSent(WelcomeUserMail::class, function (WelcomeUserMail $mail) {
        return $mail->hasTo('johndoe@example.com') &&
               $mail->user->email === 'johndoe@example.com' &&
               $mail->password === 'SecurePassword123!';
    });
});

test('welcome email contains correct user details and looks professional', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'username' => 'johndoe',
        'signup_bonus' => 50.00,
    ]);

    $mailable = new WelcomeUserMail($user, 'SecurePassword123!');

    $mailable->assertSeeInHtml('Welcome to');
    $mailable->assertSeeInHtml('johndoe@example.com');
    $mailable->assertSeeInHtml('johndoe');
    $mailable->assertSeeInHtml('SecurePassword123!');
    $mailable->assertSeeInHtml('$50.00');
    $mailable->assertSeeInHtml('Access Your Dashboard');
});
