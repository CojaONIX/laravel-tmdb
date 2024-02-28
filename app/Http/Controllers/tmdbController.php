<?php

namespace App\Http\Controllers;

use App\Repositories\tmdbRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\View\View;

class tmdbController extends Controller
{
    private $tmdRepo;
    public function __construct()
    {
        $this->tmdRepo = new tmdbRepository();
    }

    public function getMovieGroup(Request $request): View
    {

        $group = $request->get('movie-group', 'popular');
        $page = $request->get('page', 1);
        $page = $page ? $page : 1;
        $page =  Number::clamp($page, min: 1, max: 500);

        $items = json_decode($this->tmdRepo->getMovieGroup($group, $page));
        $genres = $this->tmdRepo->genres;

        return view('movie.items', compact('items', 'genres'));

    }

    public function getMovieDetails($movie)
    {
        $item = json_decode($this->tmdRepo->getMovieDetails($movie));
        return view('movie.details', compact('item'));
    }

    public function getMovieSearch(Request $request): View
    {

        $items = json_decode($this->tmdRepo->getMovieSearch($request->get('query')));
        $genres = $this->tmdRepo->genres;

        return view('movie.items', compact('items', 'genres'));

    }
}
