<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\ModifiedGif;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModifiedGifsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_modified_gif()
    {
        $gif = factory(ModifiedGif::class)->create();

        $res = $this->get(route('modified.index'));

        $res->assertStatus(200)
            ->assertSeeText($gif['title'])
            ->assertSee($gif['url']);
    }

    /** @test */
    public function can_search_gifs()
    {
        $blueGif = factory(ModifiedGif::class)->create([
            'title' => 'Blue Gif'
        ]);

        $redGif = factory(ModifiedGif::class)->create([
            'title' => 'Red Gif'
        ]);

        $res = $this->get(route('modified.search', ['search' => 'blue']));

        $res->assertStatus(200)
            ->assertSeeText($blueGif['title'])
            ->assertDontSeeText($redGif['title']);
    }
}
