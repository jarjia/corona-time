<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
        
    }

    public function test_auth_should_return_errors_if_input_is_not_provided() 
    {
        $response = $this->post('/login');

        $response->assertSessionHasErrors([
            'username_or_email',
            'password'
        ]);
    }

    public function test_auth_should_give_us_username_or_email_error_if_we_dont_provide_it()
    {
        $response = $this->post('/login', [
            'password' => 'my-password'
        ]);

        $response->assertSessionHasErrors([
            'username_or_email'
        ]);
        $response->assertSessionDoesntHaveErrors(['password']);
    }

    public function test_auth_should_give_us_username_or_email_error_if_we_input_characters_less_than_three() 
    {
        $response = $this->post('/login', [
            'username_or_email' => 'na'
        ]);
        
        $response->assertSessionHasErrors([
            'username_or_email'
        ]);
    }

    public function test_auth_should_give_us_password_error_if_we_dont_provide_it() 
    {
        $response = $this->post('/login', [
            'username_or_email' => 'name@gmail.com'
        ]);

        $response->assertSessionHasErrors([
            'password'
        ]);

        $response->assertSessionDoesntHaveErrors(['username_or_email']);
    }

    public function test_auth_should_give_us_error_if_user_with_provided_credentials_does_not_exist() 
    {
        $response = $this->post('/login', [
            'username_or_email' => 'name',
            'password' => 'my-password'
        ]);

        $response->assertSessionHasErrors([
            'username_or_email' => 'User with that username or email does not exist'
        ]);
    }

    public function test_auth_should_redirect_us_to_dashboard_page_if_authenticated() 
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $response = $this->get('/login');
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/world-wide');
    }

    public function test_auth_should_not_let_us_log_out_if_we_are_not_logged_in() 
    {
        $this->get('/logout')->assertRedirect('/signup');
    }

    public function test_auth_user_can_log_out() 
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/logout')->assertRedirect('/login');
    }

    public function test_auth_remember_this_device_token()
    {
        $email = 'jarji@gmail.com';
        $password = 'my-password';

        $user = User::factory()->create([
            'email' => $email,
            'password' => $password,
        ]);
        
        $response = $this->post('/login', [
            'username_or_email' => $email,
            'password' => $password,
            'remember_token' => 'on',
        ]);
        
        $response->assertRedirect('/dashboard/world-wide');
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_should_redirect_to_dashboard_page_after_successful_login() 
    {
        $email = 'jarji@gmail.com';
        $password = 'abuashvili';

        User::factory()->create([
            'email' => $email,
            'password' => $password,
        ]);

        $response = $this->post('/login', [
            'username_or_email' => $email,
            'password' => $password
        ]);

        $response->assertRedirect('/dashboard/world-wide');
    }
}
