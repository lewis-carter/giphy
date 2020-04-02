<?php

namespace App\Services\Giphy;

use Illuminate\Support\Facades\Http;

class Giphy
{
    protected $endpoint;
    protected $params;

    public function __construct()
    {
        $this->endpoint = 'api.giphy.com/v1/gifs/trending';
        $this->params = ['api_key' => config('services.giphy.key')];
    }

    public function get()
    {
        $res = Http::get($this->endpoint, $this->params);

        return $res->ok() ? $res->json()['data'] : [];
    }

    public function trending()
    {
        $this->endpoint = 'api.giphy.com/v1/gifs/trending';

        return $this;
    }

    public function search($search)
    {
        $this->endpoint = 'api.giphy.com/v1/gifs/search';

        $this->params['q'] = $search;

        return $this;
    }
}
