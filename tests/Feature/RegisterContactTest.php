<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterContactTest extends TestCase
{
    /**
     * @test
     */
    public function status_302_user_can_not_store_contact_without_authenticated()
    {
        $this->post('/contacts/store',
            [
                'user_id' => 1,
                'phones' => ['(23) 99999-9999'],
                'email' => 'test@test.tt',
                'name' => 'Test Contact'
            ]
        )->assertStatus(302);
    }

    /**
     * @test
     */
    public function redirect_user_can_not_store_contact_without_authenticated()
    {
        $this->post('/contacts/store',
            [
                'user_id' => 1,
                'phones' => '(23) 99999-9999',
                'email' => 'test@test.tt',
                'name' => 'Test Contact'
            ]
        )->assertRedirect('/register');
    }

    /**
     * @test
     */
    public function user_can_store_contact_with_correct_input()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post('/contacts/store', [
                'phones' => ['(23) 99999-9999'],
                'email' => 'test@test.tt',
                'name' => 'Test Contact'
            ])
            ->assertOk();
    }

    /**
     * @test
     */
    public function user_can_not_store_contact_with_no_name()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post('/contacts/store', [
                'user_id' => $user->id,
                'email' => 'test@test.tt',
            ])
            ->assertSessionMissing('email')
            ->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function user_can_not_store_contact_with_no_email()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post('/contacts/store', [
                'name' => 'Test unit'
            ])
            ->assertSessionMissing('name')
            ->assertSessionHasErrors('email');
    }
}
