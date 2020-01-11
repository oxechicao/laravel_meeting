<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Faker\Generator as Faker;

class LoginUserTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function can_user_view_login_uri_page()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function can_user_view_login_root_uri_page()
    {
        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * @test
     */
    public function can_user_login_with_correct_credentials()
    {
        $password = 'password';
        $user = factory(User::class)->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function error_user_login_with_invalid_email()
    {
        $user = factory(User::class)->create([
            'email' => \Illuminate\Support\Str::random(32)
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password,
        ])->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function user_login_with_no_email_no_password()
    {
        $this->post('/login')->assertSessionHasErrors('email')->assertSessionHasErrors('password');
    }

    /**
     * @test
     */
    public function user_login_with_no_email_with_password()
    {
        $this->post('/login', ['password' => 'password'])->assertSessionHasErrors('email')->assertSessionMissing('password');
    }

    /**
     * @test
     */
    public function user_login_with_with_email_no_password()
    {
        $this->post('/login', ['email' => 'user@dev.com'])->assertSessionHasErrors('password')->assertSessionMissing('email');
    }

    /**
     * @test
     */
    public function user_being_redirect_to_root_when_login_with_incorrect_credentials()
    {
        $password = 'password';
        $user = factory(User::class)->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'lambari',
        ]);

        $response->assertRedirect('/');
    }

    /**
     * @test
     */
    public function session_errors_email_when_user_login_with_incorrect_credentials()
    {
        $password = 'password';
        $user = factory(User::class)->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'lambari',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function old_input_true_email_when_user_login_with_incorrect_credentials()
    {
        $password = 'password';
        $user = factory(User::class)->create([
            'password' => Hash::make($password)
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'lambari',
        ]);

        $this->assertTrue(session()->hasOldInput('email'));
    }

    /**
     * @test
     */
    public function old_input_false_password_when_user_login_with_incorrect_credentials()
    {
        $password = 'password';
        $user = factory(User::class)->create([
            'password' => Hash::make($password)
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'lambari',
        ]);

        $this->assertFalse(session()->hasOldInput('password'));
    }

    /**
     * @test
     */
    public function guest_when_user_login_with_incorrect_credentials()
    {
        $password = 'password';
        $user = factory(User::class)->create([
            'password' => Hash::make($password)
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'lambari',
        ]);

        $this->assertGuest();
    }
}
