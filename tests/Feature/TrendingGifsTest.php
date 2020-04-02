<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repository\GifRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrendingGifsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(GifRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive()->getTrendingGifs()->andReturn($this->trendingGifs());
        });
    }

    /** @test */
    public function can_see_trending_gifs()
    {
        $res = $this->get(route('trending.index'));

        $res->assertSeeText("Trending Giphy Title")
            ->assertSee('https://media0.giphy.com/media/trending.gif');
    }

    /** @test */
    public function trending_gifs_are_cached()
    {
        $this->assertFalse(Cache::has('trending_gifs'));

        $this->get(route('trending.index'));

        $this->assertTrue(Cache::has('trending_gifs'));
    }

    private function trendingGifs()
    {
        return [
            [
                'title' => 'Trending Giphy Title',
                'images' => [
                    'downsized' => [
                        'url' => 'https://media0.giphy.com/media/trending.gif'
                    ]
                ]
            ]
        ];
    }
}
