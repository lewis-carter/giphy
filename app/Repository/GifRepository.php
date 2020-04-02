<?php

namespace App\Repository;

use Facades\App\Services\Giphy\Giphy;
use App\Repository\GifRepositoryInterface;

class GifRepository implements GifRepositoryInterface
{
    public function getTrendingGifs()
    {
        return Giphy::trending()->get();
    }

    public function searchGifs($search)
    {
        return Giphy::search($search)->get();
    }
}
