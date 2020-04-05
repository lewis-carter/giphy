<?php

namespace App\Jump24;

use App\Models\Gif;
use Illuminate\Support\Facades\Http;

class Giphy
{
    protected $params;

    public function __construct()
    {
        $this->params = ['api_key' => config('services.giphy.key')];
    }

    public function trending()
    {
        $res = Http::get('api.giphy.com/v1/gifs/trending', $this->params);

        return $res->ok() ? $this->collection($res->json()['data']) : [];
    }

    public function search($search)
    {
        $this->params['q'] = $search;

        $res = Http::get('api.giphy.com/v1/gifs/search', $this->params);

        return $res->ok() ? $this->collection($res->json()['data']) : [];
    }

    public function random()
    {
        $res = Http::get('api.giphy.com/v1/gifs/random', $this->params);

        return $res->ok() ? $this->single($res->json()['data']) : [];
    }

    private function collection($gifs)
    {
        return collect($gifs)->map(function ($gif) {
            return Gif::make([
                'title' => $gif['title'],
                'url' => $gif['images']['downsized']['url']
            ]);
        });
    }

    private function single($gif)
    {
        return Gif::make([
            'title' => $gif['title'],
            'url' => $gif['images']['downsized']['url']
        ]);
    }
}
