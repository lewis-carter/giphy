<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\Giphy\Giphy;
use Tests\Stubs\Giphy\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrendingGifsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(Giphy::class, function ($mock) {
            $mock->shouldReceive('trending->get')->andReturn(Collection::get());
        });
    }

    /** @test */
    public function can_see_trending_gifs()
    {
        $res = $this->get(route('trending.index'));

        $res->assertSeeText("Collection Gif Name")
            ->assertSee('https://collection.gif');
    }

    /** @test */
    public function trending_gifs_are_cached()
    {
        $this->assertFalse(Cache::has('trending_gifs'));

        $this->get(route('trending.index'));

        $this->assertTrue(Cache::has('trending_gifs'));
    }
}
