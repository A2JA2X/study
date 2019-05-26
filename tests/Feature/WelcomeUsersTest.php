<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_welcome_users_with_nickname()
    {
        $this->get('/hello/Josh/JJo')
            ->assertStatus(200)
            ->assertSee('Hi, Josh. your nickname is: JJo');
    }

    /** @test */
    function it_welcome_users_without_nickname()
    {
        $this->get('/hello/Josh')
            ->assertStatus(200)
            ->assertSee('Hi, Josh. nickname is not defined!');
    }
}
