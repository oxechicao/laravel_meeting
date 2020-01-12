<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyContactTest extends TestCase
{
    /**
     * @test
     */
    public function status_405_user_can_not_post_to_destroy_route()
    {
        $this->post('/contacts/destroy/1',
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
    public function status_302_user_can_not_destroy_contact_without_authenticated()
    {
        $this->delete('/contacts/destroy/1',
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
    public function redirect_user_can_not_destroy_contact_without_authenticated()
    {
        $this->delete('/contacts/destroy',
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
    public function user_can_destroy_contact_with_correct_delete()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->delete('/contacts/destroy/' . $contact->id)
            ->assertOk();
    }

    /**
     * @test
     */
    public function user_can_not_delete_without_id()
    {
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->delete('/contacts/destroy/')
            ->assertStatus(404);
    }
}
