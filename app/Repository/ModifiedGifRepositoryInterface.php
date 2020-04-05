<?php

namespace App\Repository;

interface ModifiedGifRepositoryInterface
{
    public function store($gifs);

    public function paginate();

    public function search($search);
}
