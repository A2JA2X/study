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
    function it_display_the_users_details_page()
    {
        $user = factory(User::class)->create([
            'name' => 'Jorge'
        ]);
        $this->get('/users/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Jorge');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('New user');
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/users/1000')
            ->assertStatus(404)
            ->assertSee('Page not found');
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $this->post('/users/create', [
            'name' => 'Marco',
            'email' => 'Polo@test.test',
            'password' => 'test12345678'
        ])->assertRedirect(route('users'));

        $this->assertCredentials([
            'name' => 'Marco',
            'email' => 'Polo@test.test',
            'password' => 'test12345678'
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
        $this->from('users/new')
            ->post('/users/create', [
                'name' => '',
                'email' => 'Polo@test.test',
                'password' => 'test12345678'
            ])
            ->assertRedirect(route('users.new'))
            ->assertSessionHasErrors(['name' => 'Name is required!']);

        $this->assertEquals(0, User::count());

//        $this->assertDatabaseMissing('users', [
//            'email' => 'Polo@test.test',
//        ]);
    }
}
