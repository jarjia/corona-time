<?php

namespace Tests\Feature;

use App\Http\Controllers\RegisterController;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Mockery;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_should_be_accessible() 
    {
        $response = $this->get('/signup');

        $response->assertSuccessful();
        $response->assertViewIs('auth.signup');
    }

    public function test_register_should_give_us_errors_if_we_dont_provide_inputs() 
    {
        $response = $this->post('/signup');

        $response->assertSessionHasErrors([
            'name',
            'email',
            'password'
        ]);
    }

    public function test_register_should_give_us_name_error_if_we_dont_provide_it()
    {
        $response = $this->post('/signup', [
            'email' => 'text@gmail.com',
            'password' => '123',
            'password_confirmation' => '123'
        ]);

        $response->assertSessionHasErrors([
            'name'
        ]);
        $response->assertSessionDoesntHaveErrors(['email', 'password']);
    }

    public function test_register_should_give_us_name_error_if_we_provide_it_with_less_than_three_characters()
    {
        $response = $this->post('/signup', [
            'name' => 'na'
        ]);

        $response->assertSessionHasErrors([
            'name'
        ]);
    }

    public function test_register_should_give_us_name_error_if_the_name_is_already_taken()
    {
        $name = 'john';

        User::factory()->create([
            'name' => $name
        ]);

        $response = $this->post('/signup', [
            'name' => $name
        ]);

        $response->assertSessionHasErrors([
            'name'
        ]);
    }

    public function test_register_should_give_us_email_error_if_we_dont_provide_it()
    {
        $response = $this->post('/signup', [
            'name' => 'john',
            'password' => '123',
            'password_confirmation' => '123'
        ]);

        $response->assertSessionHasErrors([
            'email'
        ]);
        $response->assertSessionDoesntHaveErrors(['name', 'password']);
    }

    public function test_register_should_give_us_email_error_if_the_email_is_already_taken()
    {
        $email = 'text@gmail.com';

        User::factory()->create([
            'email' => $email
        ]);

        $response = $this->post('/signup', [
            'email' => $email
        ]);

        $response->assertSessionHasErrors([
            'email'
        ]);
    }

    public function test_register_should_give_us_password_error_if_we_dont_provide_it()
    {
        $response = $this->post('/signup', [
            'name' => 'john',
            'email' => 'text@gmail.com',
        ]);

        $response->assertSessionHasErrors([
            'password'
        ]);
        $response->assertSessionDoesntHaveErrors(['name', 'email']);
    }

    public function test_register_should_give_us_password_error_if_passwords_dont_match()
    {
        $response = $this->post('/signup', [
            'password' => '123',
            'password_confirmation' => '1234',
        ]);

        $response->assertSessionHasErrors([
            'password_confirmation'
        ]);
    }

    public function test_register_verify_page_should_be_accessible() 
    {
        $email = 'text@gmail.com';
        $password = '123';

        $user = User::factory()->create([
            'email' => $email,
            'password' => $password
        ]);

        $this->actingAs($user)->post('/login', [
            'username_or_email' => $email,
            'password' => $password
        ]);

        $response = $this->get('/email/verify');

        $response->assertSuccessful();
        $response->assertViewIs('auth.verify');
    }

    public function test_register_should_redirect_us_to_message_route_when_verification_mail_is_sent()
    {
        Mail::fake();

        $attributes = [
            'name' => 'name',
            'email' => 'text@gmail.com',
            'password' => '123',
        ];

        $response = $this->post('/signup', $attributes);

        $user = User::firstWhere('email', $attributes['email']);

        $this->actingAs($user)->post('/login', [
            'username_or_email' => $attributes['email'],
            'password' => $attributes['password']
        ]);

        $response->assertRedirect('/email/verify');
    }

    public function test_register_should_verify_user_and_redirect_them_to_email_verified_page() 
    {
        $user = User::factory()->create(['email_verified_at' => null]);
    
        $this->actingAs($user);
    
        $this->get(route('verification.notice'))->assertOk();
    
        $this->assertNull($user->email_verified_at);

        $url = URL::signedRoute('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->getEmailForVerification()),
        ]);
    
        $this->actingAs($user)
        ->get($url)
        ->assertRedirect(route('email.verified'));
    
        $this->assertNotNull($user->fresh()->email_verified_at);
    }
}
