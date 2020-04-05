<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Repository\GifRepositoryInterface;

class TrendingGifsController extends Controller
{
    private $gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->gifRepository = $gifRepository;
    }

    public function index()
    {
        $gifs = Cache::remember('trending_gifs', 60 * 60, function () {
            return $this->gifRepository->getTrending();
        });

        return view('home', compact('gifs'));
    }
}
