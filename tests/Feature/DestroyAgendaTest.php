<?php

namespace Tests\Feature;

use App\Agenda;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyAgendaTest extends TestCase
{
    /**
     * @test
     */
    public function status_405_user_can_not_post_to_destroy_route()
    {
        $this->post('/agendas/destroy/1')->assertStatus(405);
    }

    /**
     * @test
     */
    public function status_302_user_can_not_destroy_agenda_without_authenticated()
    {
        $this->delete('/agendas/destroy/1')->assertStatus(302);
    }

    /**
     * @test
     */
    public function redirect_user_can_not_destroy_agenda_without_authenticated()
    {
        $this->delete('/agendas/destroy')->assertRedirect('/register');
    }

    /**
     * @test
     */
    public function user_can_destroy_agenda_with_correct_delete()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->delete('/agendas/destroy/' . $agenda->id)
            ->assertOk();
    }

    /**
     * @test
     */
    public function user_can_not_delete_without_id()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user)
            ->delete('/agendas/destroy/')
            ->assertStatus(404);
    }
}
