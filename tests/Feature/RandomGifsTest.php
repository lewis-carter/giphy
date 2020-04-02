<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Stubs\Giphy\Single;
use App\Repository\GifRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RandomGifsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(GifRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive()->randomGif()->andReturn(Single::get());
        });
    }

    /** @test */
    public function deposits_random_giphy_response_to_random_gifs_table()
    {
        $this->get(route('random.show'));

        $this->assertDatabaseHas('random_gifs', [
            'name' => 'Single Gif Name',
        ]);
    }
}
