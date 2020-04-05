<?php

namespace Tests\Feature;

use App\Models\Gif;
use Tests\TestCase;
use App\Services\Giphy\Giphy;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RandomGifsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $gif;

    public function setUp(): void
    {
        parent::setUp();

        $this->gif = factory(Gif::class)->make();

        $this->mock(Giphy::class, function ($mock) {
            $mock->shouldReceive('random')->andReturn($this->gif);
        });
    }

    /** @test */
    public function deposits_random_giphy_response_to_gifs_table()
    {
        $res = $this->get(route('random.index'));

        $this->assertDatabaseHas('gifs', [
            'title' => $this->gif['title'],
            'url' => $this->gif['url'],
        ]);
    }

    /** @test */
    public function creates_modified_records()
    {
        $res = $this->get(route('random.index'));

        $this->assertDatabaseHas('gifs', [
            'title' => $this->gif['title'],
            'url' => $this->gif['url'],
            'modified' => '1'
        ]);

        $this->assertDatabaseHas('modified_gifs', [
            'title' => $this->gif['title'] . time(),
            'url' => $this->gif['url'],
        ]);
    }

    /** @test */
    public function can_see_random_gif()
    {
        $res = $this->get(route('random.index'));

        $res->assertStatus(200)
            ->assertSeeText($this->gif['name'])
            ->assertSee($this->gif['url']);
    }
}
