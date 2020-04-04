<?php

namespace App\Repository;

interface GifRepositoryInterface
{
    public function getTrendingGifs();

    public function searchGifs($search);

    public function getRandomGifs();

    public function store($gifs);
}
