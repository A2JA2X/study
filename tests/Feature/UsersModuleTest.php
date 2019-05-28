<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /** rollback after one test */
    use RefreshDatabase;

    /** @test */
    function it_show_the_users_list()
    {
        /** create new dummy user */
        factory(User::class)->create([
            'name' => 'Josh',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('List of users')
            ->assertSee('Josh')
            ->assertSee('Ellie');
    }

    /** @test */
    function it_shows_a_default_message_if_there_are_no_users()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('No users.');
    }

    /** @test */
    function it_loads_the_users_details_page()
    {
        $this->get('/users/5')
            ->assertStatus(200)
            ->assertSee('Details for user: 5');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('New user');
    }

    /** @test */
    function it_loads_the_create_users_page()
    {
        $this->get('/users/create')
            ->assertStatus(200)
            ->assertSee('Create user');
    }
}
