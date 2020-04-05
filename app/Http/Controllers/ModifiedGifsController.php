<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchGifsRequest;
use App\Repository\ModifiedGifRepositoryInterface;

class ModifiedGifsController extends Controller
{
    private $modifiedGifRepository;

    public function __construct(ModifiedGifRepositoryInterface $modifiedGifRepository)
    {
        $this->modifiedGifRepository = $modifiedGifRepository;
    }

    public function index()
    {
        $gifs = $this->modifiedGifRepository->paginate();

        return view('modified', compact('gifs'));
    }

    public function search(SearchGifsRequest $request)
    {
        $gifs = $this->modifiedGifRepository->search($request->search);

        return view('modified', compact('gifs'));
    }
}
