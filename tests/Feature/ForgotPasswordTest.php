<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_forgot_password_page_is_accessible()
    {
        $response = $this->get('/forgot-password');

        $response->assertSuccessful();
        $response->assertViewIs('auth.verifyPassword.email-confirm');
    }

    public function test_forgot_password_should_give_us_error_if_email_is_not_provided()
    {
        $response = $this->post('/forgot-password');

        $response->assertSessionHasErrors([
            'email'
        ]);
    }

    public function test_forgot_password_should_give_us_error_if_email_is_provided_in_incorrect_format()
    {
        $response = $this->post('/forgot-password', [
            'email' => 'textgmail.com'
        ]);

        $response->assertSessionHasErrors([
            'email'
        ]);
    }

    public function test_forgot_password_confirmation_page_is_accessible() 
    {
        $response = $this->get('/forgot-password/recover/verify');

        $response->assertSuccessful();
        $response->assertViewIs('auth.verify');
    }

    public function test_forgot_password_send_method_redirects_to_message_route_when_reset_link_is_sent()
    {
        Notification::fake();

        $user = User::factory()->create();
    
        $response = $this->post('/forgot-password', ['email' => $user->email]);

        $response->assertRedirect(route('recover.password.message'));

        Notification::assertSentTo(
            $user,
            ResetPasswordNotification::class
        );
    }

    public function test_forgot_password_new_password_page_is_accessible() 
    {
        $token = 'my-token';
        $email = 'text@gmail.com';

        $response = $this->get(route('recover.password.create', ['token' => $token, 'email' => $email]));

        $response->assertSuccessful();
        $response->assertViewIs('auth.verifyPassword.recover-password');
    }

    public function test_forgot_password_should_give_us_errors_if_hidden_inputs_are_not_provided() 
    {
        $response = $this->post('/forgot-password/reset-password', [
            'password' => 'my-password',
            'password_confirmation' => 'my-password'
        ]);

        $response->assertSessionHasErrors([
            'token',
            'email'
        ]);
        $response->assertSessionDoesntHaveErrors(['password', 'password_confirmation']);
    }

    public function test_forgot_password_should_give_us_errors_if_password_is_not_provided() 
    {
        $response = $this->post('/forgot-password/reset-password', [
            'token' => 'my-token',
            'email' => 'text@gmail.com'
        ]);

        $response->assertSessionHasErrors([
            'password'
        ]);
        $response->assertSessionDoesntHaveErrors(['token', 'email']);
    }

    public function test_forgot_password_should_give_us_errors_if_password_confirmation_does_not_match() 
    {
        $response = $this->post('/forgot-password/reset-password', [
            'password' => '1234',
            'password_confirmation' => '123'
        ]);

        $response->assertSessionHasErrors([
            'password'
        ]);
    }

    public function test_forgot_password_redirect_to_verified_page_after_successful_recover()
    {
        $email = 'text@gmail.com';

        $user = User::factory()->create([
            'email' => $email
        ]);

        $token = Password::createToken($user);

        $response = $this->post('/forgot-password/reset-password', [
            'token' => $token,
            'email' => $email,
            'password' => 'my-password',
            'password_confirmation' => 'my-password'
        ]);

        $response->assertRedirect('/recover-verified');
    }    

    public function test_forgot_password_notification_content_is_correct() 
    {
        Notification::fake(); 
        $token = 'my_token'; 

        $this->user->notify(new ResetPasswordNotification($token));

        Notification::assertSentTo($this->user, ResetPasswordNotification::class, function ($notification, $channels) use($token) {
            $this->assertContains('mail', $channels);
            $mailNotification = (object)$notification->toMail($this->user);

            $this->assertEquals($token, $notification->token);
            $userEmail = str_replace('@', '%40', $this->user->email);

            $this->assertEquals('Password Reset Notification', $mailNotification->subject);
            $this->assertEquals('Notification Action', $mailNotification->actionText);
            $this->assertEquals($mailNotification->actionUrl, route('recover.password.create', ['token' => 'my_token'])."?email=".$userEmail);
            
            $attachment = $mailNotification->attachments[0];
            $this->assertEquals('email-verify.png', $attachment['options']['as']);
            $this->assertEquals('email-verify/png', $attachment['options']['mime']);

            return true;
        });
    }

    public function test_forgot_password_toArray_returns_an_array_of_notification_data()
    {
        $token = 'my_token';
        $notification = new ResetPasswordNotification($token);

        $data = $notification->toArray($this->user);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('token', $data);
        $this->assertEquals($token, $data['token']);
    }
}
