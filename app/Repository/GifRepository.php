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

    public function getRandomGifs($limit = 8)
    {
        $gifs = collect();

        for ($i = 0; $i < $limit; $i++) {
            $gifs->push(Giphy::random());
        }

        return $gifs;
    }

    public function store($gifs)
    {
        return DB::table('gifs')->insert($gifs);
    }

    public function notModified()
    {
        return DB::select('select * from gifs where modified = 0');
    }

    public function modify($gifs)
    {
        $gifs = collect($gifs);

        DB::table('gifs')
            ->whereIn('id', $gifs->pluck('id')->toArray())
            ->update(['modified' => 1]);

        return $gifs->map(function ($gif) {
            return [
                'title' => $gif->title . time(),
                'url' => $gif->url
            ];
        });
    }
}
