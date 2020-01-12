<?php

namespace Tests\Feature;

use App\Agenda;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateAgendaTest extends TestCase
{
    /**
     * @test
     */
    public function status_405_user_can_not_post_update_agenda()
    {

        $this->post('/agendas/update', factory(Agenda::class)->make()->toArray())
            ->assertStatus(405);
    }

    /**
     * @test
     */
    public function status_302_user_can_not_update_agenda_without_authenticated()
    {

        $this->put('/agendas/update', factory(Agenda::class)->make()->toArray())
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function redirect_user_can_not_update_agenda_without_authenticated()
    {
        $this->put('/agendas/update', factory(Agenda::class)->make()->toArray())
            ->assertRedirect('/register');
    }

    /**
     * @test
     */
    public function user_can_update_agenda_with_correct_input()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create(['user_id' => $user->id])->toArray();
        $agenda['title'] = 'Agenda updated';
        $this->actingAs($user)
            ->put('/agendas/update/' . $agenda['id'], $agenda)
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    /**
     * @test
     */
    public function user_can_not_update_agenda_without_title()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create(['user_id' => $user->id])->toArray();
        unset($agenda['title']);
        $this->actingAs($user)
            ->put('/agendas/update/' . $agenda['id'], $agenda)
            ->assertSessionMissing('date')
            ->assertSessionMissing('hour')
            ->assertSessionMissing('description')
            ->assertSessionMissing('participants')
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function user_can_not_update_agenda_with_no_date()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create(['user_id' => $user->id])->toArray();
        unset($agenda['date']);
        $this->actingAs($user)
            ->put('/agendas/update/' . $agenda['id'], $agenda)
            ->assertSessionMissing('title')
            ->assertSessionMissing('hour')
            ->assertSessionMissing('description')
            ->assertSessionMissing('participants')
            ->assertSessionHasErrors('date');
    }

    /**
     * @test
     */
    public function user_can_not_update_agenda_with_no_hour()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create(['user_id' => $user->id])->toArray();
        unset($agenda['hour']);
        $this->actingAs($user)
            ->put('/agendas/update/' . $agenda['id'], $agenda)
            ->assertSessionMissing('title')
            ->assertSessionMissing('date')
            ->assertSessionMissing('description')
            ->assertSessionMissing('participants')
            ->assertSessionHasErrors('hour');
    }

    /**
     * @test
     */
    public function user_can_not_update_agenda_with_participants_not_array()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->create(['user_id' => $user->id])->toArray();
        $agenda['participants'] = 123;
        $this->actingAs($user)
            ->put('/agendas/update/' . $agenda['id'], $agenda)
            ->assertSessionMissing('title')
            ->assertSessionMissing('date')
            ->assertSessionMissing('description')
            ->assertSessionMissing('hour')
            ->assertSessionHasErrors('participants');
    }
}
