<?php

namespace Tests\Feature;

use App\Models\Gif;
use Tests\TestCase;
use App\Services\Giphy\Giphy;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RandomGifsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deposits_random_giphy_response_to_gifs_table()
    {
        $gif = factory(Gif::class)->make();

        $this->mock(Giphy::class, function ($mock) use ($gif) {
            $mock->shouldReceive('random')->andReturn($gif);
        });

        $res = $this->get(route('random.index'));

        $this->assertDatabaseHas('gifs', [
            'title' => $gif['title'],
            'url' => $gif['url']
        ]);
    }

    /** @test */
    public function can_see_random_gif()
    {
        $gif = factory(Gif::class)->make();

        $this->mock(Giphy::class, function ($mock) use ($gif) {
            $mock->shouldReceive('random')->andReturn($gif);
        });

        $res = $this->get(route('random.index'));

        $res->assertStatus(200)
            ->assertSeeText($gif['name'])
            ->assertSee($gif['url']);
    }
}
