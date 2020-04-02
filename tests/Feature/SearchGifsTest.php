<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\Giphy\Giphy;
use Tests\Stubs\Giphy\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchGifsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(Giphy::class, function ($mock) {
            $mock->shouldReceive('search->get')->andReturn(Collection::get());
        });
    }

    /** @test */
    public function can_search_gifs()
    {
        $res = $this->get(route('search.index', ['search' => 'wildlife']));

        $res->assertSeeText("Collection Gif Name")
            ->assertSee('https://collection.gif');
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
}
