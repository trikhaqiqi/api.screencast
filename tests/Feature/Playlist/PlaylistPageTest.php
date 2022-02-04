<?php

namespace Tests\Feature\Playlist;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaylistPageTest extends TestCase
{
    /** @test */
    public function can_see_welcome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
