<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Facades\App\Jump24\Giphy;
use App\Repository\GifRepositoryInterface;

class GifRepository implements GifRepositoryInterface
{
    public function getTrending()
    {
        return Giphy::trending();
    }

    public function getSearch($search)
    {
        return Giphy::search($search);
    }

    public function getRandom($limit = 8)
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

    public function getNotModified()
    {
        return DB::select('select * from gifs where modified = 0');
    }

    public function modify($gifs)
    {
        return DB::table('gifs')
            ->whereIn('id', collect($gifs)->pluck('id')->toArray())
            ->update(['modified' => 1]);
    }
}
