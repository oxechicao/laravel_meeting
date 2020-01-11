<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateContactTest extends TestCase
{
    /**
     * @test
     */
    public function status_405_user_can_not_post_to_update_route()
    {
        $this->post('/contacts/update/1',
            [
                'phones' => ['(23) 99999-9999'],
                'email' => 'test@test.tt',
                'name' => 'Test Contact'
            ]
        )->assertStatus(405);
    }

    /**
     * @test
     */
    public function status_302_user_can_not_update_contact_without_authenticated()
    {
        $this->put('/contacts/update/1',
            [
                'phones' => ['(23) 99999-9999'],
                'email' => 'test@test.tt',
                'name' => 'Test Contact'
            ]
        )->assertStatus(302);
    }

    /**
     * @test
     */
    public function redirect_user_can_not_update_contact_without_authenticated()
    {
        $this->put('/contacts/update',
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
    public function user_can_update_contact_with_correct_input()
    {
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->put('/contacts/update', [
                'id' => $contact->id,
                'phones' => ['(23) 12345-1234'],
                'email' => 'Test11@test.tt',
                'name' => 'Test Updated'
            ])
            ->assertOk();
    }

    /**
     * @test
     */
    public function user_can_not_update_contact_with_no_name()
    {
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->put('/contacts/update/', [
                'id' => $contact->id,
                'user_id' => $user->id,
                'email' => 'test@test.tt',
            ])
            ->assertSessionMissing('email')
            ->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function user_can_not_update_contact_with_no_email()
    {
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->put('/contacts/update/', [
                'id' => $contact->id,
                'name' => 'Test unit'
            ])
            ->assertSessionMissing('name')
            ->assertSessionHasErrors('email');
    }
}
