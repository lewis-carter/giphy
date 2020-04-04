<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\GifRepositoryInterface;

class RandomGifsController extends Controller
{
    private $gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->gifRepository = $gifRepository;
    }

    public function index()
    {
        $gifs = $this->gifRepository->getRandomGifs();

        $this->gifRepository->store($gifs->toArray());

        return view('random', compact('gifs'));
    }
}
