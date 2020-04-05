<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Facades\App\Services\Giphy\Giphy;
use App\Repository\GifRepositoryInterface;

class ModifiedGifRepository implements ModifiedGifRepositoryInterface
{
    public function store($gifs)
    {
        // Bulk Insert
        // insert into `gifs` (`title`, `url`) values
        // ('Gif Title', 'Gif Url'),
        // ('Gif Title', 'Gif Url'),
        // ...
        return DB::table('modified_gifs')->insert($gifs);
    }
}
