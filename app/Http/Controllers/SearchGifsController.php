<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\SearchGifsRequest;
use App\Repository\GifRepositoryInterface;

class SearchGifsController extends Controller
{
    private $gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->gifRepository = $gifRepository;
    }

    public function index(SearchGifsRequest $request)
    {
        $gifs = Cache::remember("{$request->search}_searched_gifs", 60, function () use ($request) {
            return $this->gifRepository->searchGifs($request->search);
        });

        return view('search', compact('gifs'));
    }
}
