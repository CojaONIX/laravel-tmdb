<?php

namespace App\Http\Controllers;

use App\Repositories\tmdbRepository;
use Illuminate\Http\Request;

class tmdbController extends Controller
{
    private $tmdRepo;
    public function __construct()
    {
        $this->tmdRepo = new tmdbRepository();
    }

    public function getPopularMovie(Request $request)
    {

        $items = json_decode($this->tmdRepo->getPopularMovie($request->page));
        $genres = $this->tmdRepo->genres;

        return view('items', compact('items', 'genres'));

    }
}
