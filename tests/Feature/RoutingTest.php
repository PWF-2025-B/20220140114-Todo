<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Programmer Zaman Now');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get(uri: '/tidakada')
            ->assertSeeText('404 by Programmer Zaman Now');

        $this->get('/tidakadalagi')
            ->assertSeeText('404 by Programmer Zaman Now');

        $this->get('/ups')
            ->assertSeeText('404 by Programmer Zaman Now');
    }
}
