<?php

namespace App\Repository;

interface GifRepositoryInterface
{
    public function getTrending();

    public function getSearch($search);

    public function getRandom();

    public function store($gifs);

    public function getNotModified();

    public function modify($gifs);
}
