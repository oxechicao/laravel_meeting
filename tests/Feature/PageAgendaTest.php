<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageAgendaTest extends TestCase
{
    /**
     * @test
     */
    public function status_302_user_can_not_view_agendas_page_without_auth()
    {
        $this->get('/agendas')->assertStatus(302);
    }

    /**
     * @test
     */
    public function redirect_to_register_user_can_not_view_agendas_page_without_auth()
    {
        $this->get('/agendas')->assertRedirect('/register');
    }
    /**
     * @test
     */
    public function user_can_view_agendas_page()
    {
        $this->actingAs(factory(User::class)->make())
            ->get('/agendas')
            ->assertOk();
    }
}
