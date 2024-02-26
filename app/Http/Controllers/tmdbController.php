<?php

namespace App\Http\Controllers;

use App\Repositories\tmdbRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class tmdbController extends Controller
{
    private $tmdRepo;
    public function __construct()
    {
        $this->tmdRepo = new tmdbRepository();
    }

    public function getPopularMovie(Request $request): View
    {

        $items = json_decode($this->tmdRepo->getPopularMovie($request->get('page')));
        $genres = $this->tmdRepo->genres;

        return view('items', compact('items', 'genres'));

    }

    public function getMovieDetails($movie)
    {
        $item = json_decode($this->tmdRepo->getMovieDetails($movie));
        return view('details', compact('item'));
    }

    public function getMovieSearch(Request $request): View
    {

        $items = json_decode($this->tmdRepo->getMovieSearch($request->get('query')));
        $genres = $this->tmdRepo->genres;

        return view('items', compact('items', 'genres'));

    }
}
