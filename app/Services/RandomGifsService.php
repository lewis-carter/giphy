<?php

namespace App\Services;

use App\Repository\GifRepositoryInterface;
use App\Repository\ModifiedGifRepositoryInterface;

class RandomGifsService
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
        // Get random gifs from giphy
        $gifs = $this->gifRepository->getRandom();

        // Store random gifs into gifs table
        $this->gifRepository->store($gifs->toArray());

        // Get the gifs that aren't modified
        $notModifiedGifs = $this->gifRepository->getNotModified();

        // Set modified on the gifs
        $this->gifRepository->modify($notModifiedGifs);

        // Modify gifs
        $modifiedGifs = collect($notModifiedGifs)->map(function ($gif) {
            return [
                'title' => $gif->title . time(),
                'url' => $gif->url
            ];
        });

        // Store updated gifs into modified gifs table
        $this->modifiedGifRepository->store($modifiedGifs->toArray());

        return $gifs;
    }
}
