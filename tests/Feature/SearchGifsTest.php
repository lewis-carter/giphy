<?php

namespace Tests\Feature;

use App\Models\Gif;
use Tests\TestCase;
use App\Jump24\Giphy;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchGifsTest extends TestCase
{
    protected $gifs;

    public function setUp(): void
    {
        parent::setUp();

        $this->gifs = factory(Gif::class, 25)->make();

        $this->mock(Giphy::class, function ($mock) {
            $mock->shouldReceive('search')->andReturn($this->gifs);
        });
    }

    /** @test */
    public function can_search_gifs()
    {
        $res = $this->get(route('search.index', ['search' => 'wildlife']));

        $res->assertStatus(200)
            ->assertSeeText($this->gifs[0]['name'])
            ->assertSee($this->gifs[0]['url']);
    }

    /** @test */
    public function searching_requries_a_search_parameter()
    {
        $res = $this->get(route('search.index'));

        $res->assertSessionHasErrors('search')
            ->assertStatus(302);
    }

    /** @test */
    public function search_result_is_cached()
    {
        $this->assertFalse(Cache::has('wildlife_searched_gifs'));

        $this->get(route('search.index', ['search' => 'wildlife']));

        $this->assertTrue(Cache::has('wildlife_searched_gifs'));
    }
}
