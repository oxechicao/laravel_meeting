<?php

namespace Tests\Feature;

use App\Agenda;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterAgendaTest extends TestCase
{
    /**
     * @test
     */
    public function status_302_user_can_not_store_agenda_without_authenticated()
    {

        $this->post('/agendas/store', factory(Agenda::class)->make()->toArray())
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function redirect_user_can_not_store_agenda_without_authenticated()
    {
        $this->post('/agendas/store', factory(Agenda::class)->make()->toArray())
            ->assertRedirect('/register');
    }

    /**
     * @test
     */
    public function user_can_store_agenda_with_correct_input()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post(
                '/agendas/store',
                factory(Agenda::class)->make(['user_id' => $user->id])->toArray()
            )
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    /**
     * @test
     */
    public function user_can_not_store_agenda_with_no_title()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->make(['user_id' => $user->id])->toArray();
        unset($agenda['title']);
        $this->actingAs($user)
            ->post('/agendas/store', $agenda)
            ->assertSessionMissing('date')
            ->assertSessionMissing('hour')
            ->assertSessionMissing('description')
            ->assertSessionMissing('participants')
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function user_can_not_store_agenda_with_no_date()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->make(['user_id' => $user->id])->toArray();
        unset($agenda['date']);
        $this->actingAs($user)
            ->post('/agendas/store', $agenda)
            ->assertSessionMissing('title')
            ->assertSessionMissing('hour')
            ->assertSessionMissing('description')
            ->assertSessionMissing('participants')
            ->assertSessionHasErrors('date');
    }

    /**
     * @test
     */
    public function user_can_not_store_agenda_with_no_hour()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->make(['user_id' => $user->id])->toArray();
        unset($agenda['hour']);
        $this->actingAs($user)
            ->post('/agendas/store', $agenda)
            ->assertSessionMissing('title')
            ->assertSessionMissing('date')
            ->assertSessionMissing('description')
            ->assertSessionMissing('participants')
            ->assertSessionHasErrors('hour');
    }

    /**
     * @test
     */
    public function user_can_not_store_agenda_with_participants_not_array()
    {
        $user = factory(User::class)->create();
        $agenda = factory(Agenda::class)->make(['user_id' => $user->id, 'participants' => 123])->toArray();
        $this->actingAs($user)
            ->post('/agendas/store', $agenda)
            ->assertSessionMissing('title')
            ->assertSessionMissing('date')
            ->assertSessionMissing('description')
            ->assertSessionMissing('hour')
            ->assertSessionHasErrors('participants');
    }
}
