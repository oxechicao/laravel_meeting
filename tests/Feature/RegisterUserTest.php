<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RegisterUserTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function user_can_view_register_page_root()
    {
        $this->get('/')->assertStatus(200);
    }

    /**
     * @test
     */
    public function user_can_view_register_page()
    {
        $this->get('/register')->assertStatus(200);
    }

    /**
     * @test
     */
    public function user_can_not_register_with_no_input()
    {
        $this->post('/register')->assertSessionHasErrors()
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('password')
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function user_can_not_register_with_no_confirm_password()
    {
        $this->post('/register', [
            'name' => Str::random(10),
            'password' => Str::random(8),
            'email' => Str::random(4) . '@' . Str::random(4) . '.' . Str::random(3),
        ])->assertSessionHasErrors('password')
        ->assertSessionMissing('name')
        ->assertSessionMissing('email');
    }

    /**
     * @test
     */
    public function user_can_not_register_with_invalid_email()
    {
        $passwd = Str::random(8);
        $this->post('/register', [
            'name' => Str::random(10),
            'password' => $passwd,
            'password_confirmation' => $passwd,
            'email' => Str::random(10),
        ])->assertSessionHasErrors('email')
            ->assertSessionMissing('name')
            ->assertSessionMissing('password');
    }

    /**
     * @test
     */
    public function user_can_not_register_with_no_name()
    {
        $passwd = Str::random(8);

        $this->post('/register', [
            'password' => $passwd,
            'password_confirmation' => $passwd,
            'email' => Str::random(4) . '@' . Str::random(4) . '.' . Str::random(3),
        ])->assertSessionHasErrors('name')
            ->assertSessionMissing('password')
            ->assertSessionMissing('email');
    }

    /**
     * @test
     */
    public function user_can_register_with_corret_inputs()
    {
        $passwd = Str::random(8);

        $this->post('/register', [
            'name' => Str::random(10),
            'password' => $passwd,
            'password_confirmation' => $passwd,
            'email' => Str::random(4) . '@' . Str::random(4) . '.' . Str::random(3),
        ])->assertSessionHasNoErrors();
    }
}
