<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Facades\App\Services\Giphy\Giphy;
use App\Repository\GifRepositoryInterface;

class ModifiedGifRepository implements ModifiedGifRepositoryInterface
{
    public function store($gifs)
    {
        return DB::table('modified_gifs')->insert($gifs);
    }

    public function paginate()
    {
        return DB::table('modified_gifs')->inRandomOrder()->simplePaginate(15);
    }

    public function search($search)
    {
        return DB::table('modified_gifs')->where('title', 'like', "%{$search}%")->simplePaginate(15);
    }
}
