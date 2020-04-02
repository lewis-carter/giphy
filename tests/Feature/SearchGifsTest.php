<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use App\Repository\GifRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchGifsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(GifRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive()->searchGifs('wildlife')->andReturn($this->searchedGifs());
        });
    }

    /** @test */
    public function can_search_gifs()
    {
        $res = $this->get(route('search.index', ['search' => 'wildlife']));

        $res->assertSeeText("Searched Giphy Title")
            ->assertSee('https://media0.giphy.com/media/trending.gif');
    }

    /** @test */
    public function searching_requries_a_search_parameter()
    {
        $res = $this->get(route('search.index'));

        $res->assertStatus(302);
    }

    /** @test */
    public function search_result_is_cached()
    {
        $this->assertFalse(Cache::has('wildlife_searched_gifs'));

        $this->get(route('search.index', ['search' => 'wildlife']));

        $this->assertTrue(Cache::has('wildlife_searched_gifs'));
    }

    private function searchedGifs()
    {
        return [
            [
                'title' => 'Searched Giphy Title',
                'images' => [
                    'downsized' => [
                        'url' => 'https://media0.giphy.com/media/trending.gif'
                    ]
                ]
            ]
        ];
    }
}
