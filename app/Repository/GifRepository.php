<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Facades\App\Services\Giphy\Giphy;
use App\Repository\GifRepositoryInterface;

class GifRepository implements GifRepositoryInterface
{
    public function getTrendingGifs()
    {
        return Giphy::trending();
    }

    public function searchGifs($search)
    {
        return Giphy::search($search);
    }

    public function getRandomGifs($limit = 5)
    {
        // There isn't an endpoint to return a collection of
        // random gifs so we'll do it manually
        $gifs = collect();

        for ($i = 0; $i < $limit; $i++) {
            $gifs->push(Giphy::random());
        }

        return $gifs;
    }

    public function store($gifs)
    {
        // Bulk Insert
        // insert into `gifs` (`title`, `url`) values
        // ('Gif Title', 'Gif Url'),
        // ('Gif Title', 'Gif Url'),
        // ...
        DB::table('gifs')->insert($gifs);
    }
}
