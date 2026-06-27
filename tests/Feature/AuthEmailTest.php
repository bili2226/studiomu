<?php

namespace Tests\Feature;

use App\Models\User;
use App\Mail\RegistrationSuccessMail;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_sends_welcome_email()
    {
        Mail::fake();

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'role' => 'customer',
        ]);

        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertNotNull($user);

        Mail::assertSent(RegistrationSuccessMail::class, function ($mail) use ($user) {
            return $mail->hasTo('johndoe@example.com') && $mail->user->id === $user->id;
        });
    }

    public function test_forgot_password_sends_custom_reset_notification()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'johndoe@example.com',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        Notification::assertSentTo(
            $user,
            CustomResetPasswordNotification::class,
            function ($notification, $channels) use ($user) {
                return in_array('mail', $channels) && !empty($notification->token);
            }
        );
    }

    public function test_user_can_reset_password_with_valid_token()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => Hash::make('old_password'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => 'johndoe@example.com',
            'password' => 'new_password123',
            'password_confirmation' => 'new_password123',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status');

        $this->assertTrue(Hash::check('new_password123', $user->fresh()->password));
    }
}
