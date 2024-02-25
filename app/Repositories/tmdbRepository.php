<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class tmdbRepository
{

    public $genres;
    public function __construct()
    {
        $genres = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/genre/movie/list');

        $inputArray = $genres['genres'];
        $ids = array_column($inputArray, 'id');
        $names = array_column($inputArray, 'name');

        $this->genres = array_combine($ids, $names);
    }
    public function getPopularMovie($page=1)
    {
        $movies = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/movie/popular', [
                'page' => $page,
                'language' => 'en-US',
                'region' => ''
            ]);

        return $movies;
    }
}
