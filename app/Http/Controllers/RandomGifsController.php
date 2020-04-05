<?php

namespace App\Http\Controllers;

use App\Services\RandomGifsService;

class RandomGifsController extends Controller
{
    private $randomGifsService;

    public function __construct(RandomGifsService $randomGifsService)
    {
        $this->randomGifsService = $randomGifsService;
    }

    public function index()
    {
        $gifs = $this->randomGifsService->index();

        return view('random', compact('gifs'));
    }
}
