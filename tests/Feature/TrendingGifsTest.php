<?php

namespace Tests\Feature;

use App\Models\Gif;
use Tests\TestCase;
use App\Jump24\Giphy;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrendingGifsTest extends TestCase
{
    /** @test */
    public function can_see_trending_gifs()
    {
        $gifs = factory(Gif::class, 25)->make();

        $this->mock(Giphy::class, function ($mock) use ($gifs) {
            $mock->shouldReceive('trending')->andReturn($gifs);
        });

        $res = $this->get(route('trending.index'));

        $res->assertStatus(200)
            ->assertSeeText($gifs[0]['name'])
            ->assertSee($gifs[0]['url']);
    }

    /** @test */
    public function trending_gifs_are_cached()
    {
        $this->assertFalse(Cache::has('trending_gifs'));

        $this->get(route('trending.index'));

        $this->assertTrue(Cache::has('trending_gifs'));
    }
}
