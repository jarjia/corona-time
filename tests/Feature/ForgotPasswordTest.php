<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

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
}
