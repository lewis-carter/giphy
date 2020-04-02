<?php

namespace App\Repository;

interface GifRepositoryInterface
{
    public function getTrendingGifs();

    public function searchGifs($search);
}
