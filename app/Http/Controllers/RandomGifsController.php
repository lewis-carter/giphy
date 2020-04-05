<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\GifRepositoryInterface;
use App\Repository\ModifiedGifRepositoryInterface;

class RandomGifsController extends Controller
{
    private $gifRepository;
    private $modifiedGifRepository;

    public function __construct(GifRepositoryInterface $gifRepository, ModifiedGifRepositoryInterface $modifiedGifRepository)
    {
        $this->gifRepository = $gifRepository;
        $this->modifiedGifRepository = $modifiedGifRepository;
    }

    public function index()
    {
        $gifs = $this->gifRepository->getRandomGifs();

        $this->gifRepository->store($gifs->toArray());

        $notModifiedGifs = $this->gifRepository->notModified();

        $modifiedGifs = $this->gifRepository->modify($notModifiedGifs);

        $this->modifiedGifRepository->store($modifiedGifs->toArray());

        return view('random', compact('gifs'));
    }
}
