<?php

namespace App\Http\Controllers;

use App\Repositories\tmdbRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;
use Illuminate\View\View;

class tmdbController extends Controller
{
    private $tmdbRepo;

    public function __construct()
    {
        $this->tmdbRepo = new tmdbRepository();
    }

    public function getMediaDetails(string $media, string $id) : View
    {
        $item = $this->tmdbRepo->getMediaDetails($media, $id);
        return view($media . '.details', compact('item'));
    }

    public function getMovieGroup(Request $request): View
    {

        $group = $request->get('movie-group', 'popular');
        $page = $request->get('page', 1);
        $page = $page ? $page : 1;
        $page =  Number::clamp($page, min: 1, max: 500);

        $items = json_decode($this->tmdbRepo->getMovieGroup($group, $page));
        $genres = $this->tmdbRepo->getGenres('movie');

        return view('movie.items', compact('items', 'genres'));
    }

    public function getMovieSearch(Request $request): View
    {

        $items = json_decode($this->tmdbRepo->getMovieSearch($request->get('query')));
        $genres = $this->tmdbRepo->getGenres('movie');

        return view('movie.items', compact('items', 'genres'));

    }

    public function getTvGroup(Request $request): View
    {

        $group = $request->get('tv-group', 'popular');
        $page = $request->get('page', 1);
        $page = $page ? $page : 1;
        $page =  Number::clamp($page, min: 1, max: 500);

        $items = json_decode($this->tmdbRepo->getTvGroup($group, $page));
        $genres = $this->tmdbRepo->getGenres('tv');

        return view('tv.items', compact('items', 'genres'));
    }

    public function getTvSearch(Request $request): View
    {

        $items = json_decode($this->tmdbRepo->getTvSearch($request->get('query')));
        $genres = $this->tmdbRepo->getGenres('tv');

        return view('tv.items', compact('items', 'genres'));

    }
}
