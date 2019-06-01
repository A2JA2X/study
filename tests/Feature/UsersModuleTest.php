<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
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
    }

    /** @test */
    function the_email_is_required()
    {
        $this->from('users/new')
            ->post('/users/create', [
                'name' => 'Marco',
                'email' => '',
                'password' => 'test12345678'
            ])
            ->assertRedirect(route('users.new'))
            ->assertSessionHasErrors(['email' => 'Email is required!']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_valid()
    {
        $this->from('users/new')
            ->post('/users/create', [
                'name' => 'Marco',
                'email' => 'invalid-email',
                'password' => 'test12345678'
            ])
            ->assertRedirect(route('users.new'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_unique()
    {
        /** create new dummy user */
        factory(User::class)->create([
            'email' => 'notunique@test.com'
        ]);

        $this->from('users/new')
            ->post('/users/create', [
                'name' => 'Marco',
                'email' => 'notunique@test.com',
                'password' => 'test12345678'
            ])
            ->assertRedirect(route('users.new'))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from('users/new')
            ->post('/users/create', [
                'name' => 'Marco',
                'email' => 'Polo@test.test',
                'password' => ''
            ])
            ->assertRedirect(route('users.new'))
            ->assertSessionHasErrors(['password' => 'Password is required!']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_password_must_be_greater_than_six_characters()
    {
        $this->from('users/new')
            ->post('/users/create', [
                'name' => 'Marco',
                'email' => 'Polo@test.test',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.new'))
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        $user = factory(User::class)->create([
            'name' => 'Marco',
            'email' => 'polo@test.com',
            'password' => 'test12345678'
        ]);
        $this->get("/users/{$user->id}/edit/")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Edit user')
            ->assertViewHas('user', function($viewUser) use ($user){
                return $viewUser->id === $user->id;
            });
    }

    /** @test */
    function it_update_a_new_user()
    {
        $user = factory(User::class)->create();

        $this->put("/users/{$user->id}", [
            'name' => 'Marco',
            'email' => 'polo@test.test',
            'password' => 'test12345678'
        ])->assertRedirect("/users/{$user->id}");

        $this->assertCredentials([
            'name' => 'Marco',
            'email' => 'polo@test.test',
            'password' => 'test12345678'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from("users/{$user->id}/edit")
            ->put("/users/{$user->id}", [
                'name' => '',
                'email' => 'polo@test.test',
                'password' => 'test12345678'
            ])
            ->assertRedirect("/users/{$user->id}/edit")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'polo@test.test']);
    }

    /** @test */
    function the_email_is_required_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from("users/{$user->id}/edit")
            ->put("/users/{$user->id}", [
                'name' => 'POLO',
                'email' => '',
                'password' => 'test12345678'
            ])
            ->assertRedirect("/users/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['email' => '']);
    }

    /** @test */
    function the_email_must_be_valid_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from("users/{$user->id}/edit")
            ->put("/users/{$user->id}", [
                'name' => 'Marco',
                'email' => 'invalid-email',
                'password' => 'test12345678'
            ])
            ->assertRedirect("/users/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Marco']);
    }

    /** @test */
    function the_email_must_be_unique_when_updating_a_user()
    {
        factory(User::class)->create([
           'email' => 'same@test.com'
        ]);

        /** create new dummy user */
        $user = factory(User::class)->create([
            'email' => 'notunique@test.com'
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("/users/{$user->id}", [
                'name' => 'Marco',
                'email' => 'same@test.com',
                'password' => 'test12345678'
            ])
            ->assertRedirect("/users/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function the_users_email_can_stay_same_when_updating_a_user()
    {
        /** create new dummy user */
        $user = factory(User::class)->create([
            'email' => 'Polo@test.test'
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("/users/{$user->id}", [
                'name' => 'Marco',
                'email' => 'Polo@test.test',
                'password' => 'test12345678'
            ])
            ->assertRedirect("/users/{$user->id}");

        $this->assertDatabaseHas('users', [
            'name' => 'Marco',
            'email' => 'Polo@test.test',
        ]);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user()
    {
        /** create new dummy user */
        $oldPass = 'oldPass';
        $user = factory(User::class)->create([
            'password' => bcrypt($oldPass)
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("/users/{$user->id}", [
                'name' => 'Marco',
                'email' => 'Polo@test.test',
                'password' => ''
            ])
            ->assertRedirect("/users/{$user->id}");

        $this->assertCredentials([
            'name' => 'Marco',
            'email' => 'Polo@test.test',
            'password' => $oldPass
        ]);
    }

//    /** @test */
//    function the_password_must_be_greater_than_six_characters_when_updating_a_user()
//    {
//        /** create new dummy user */
//        $user = factory(User::class)->create();
//
//        $this->from("users/{$user->id}/edit")
//            ->put("/users/{$user->id}", [
//                'name' => 'Marco',
//                'email' => 'Polo@test.test',
//                'password' => '12345'
//            ])
//            ->assertRedirect("/users/{$user->id}/edit")
//            ->assertSessionHasErrors(['password']);
//
//        $this->assertEquals(1, User::count());
//    }
}
