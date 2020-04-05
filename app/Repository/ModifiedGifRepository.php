<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Repository\GifRepositoryInterface;

class ModifiedGifRepository implements ModifiedGifRepositoryInterface
{
    public function store($gifs)
    {
        return DB::table('modified_gifs')->insert($gifs);
    }

    public function paginate()
    {
        return DB::table('modified_gifs')->inRandomOrder()->simplePaginate(16);
    }

    public function search($search)
    {
        return DB::table('modified_gifs')->where('title', 'like', "%{$search}%")->simplePaginate(16);
    }
}
