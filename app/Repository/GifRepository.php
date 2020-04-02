<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;
use App\Repository\GifRepositoryInterface;

class GifRepository implements GifRepositoryInterface
{
    public function getTrendingGifs()
    {
        $res = Http::get("api.giphy.com/v1/gifs/trending", [
            'api_key' => config('services.giphy.key')
        ]);

        return $res->ok() ? $res->json()['data'] : [];
    }

    public function searchGifs($search)
    {
        $res = Http::get("api.giphy.com/v1/gifs/search", [
            'q' => $search,
            'api_key' => config('services.giphy.key')
        ]);

        return $res->ok() ? $res->json()['data'] : [];
    }
}
