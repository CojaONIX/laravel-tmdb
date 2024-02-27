<?php

namespace App\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class tmdbRepository
{

    public array $genres;
    public function __construct()
    {
        $genres = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/genre/movie/list', [
                'language' => 'sr'
            ]);

        foreach ($genres['genres'] as $genre)
            $this->genres[$genre['id']] = $genre['name'];

    }
    public function getPopularMovie($page=1) : Response
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

    public function getMovieDetails($movie)
    {
        $movie = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/movie/' . $movie , [
                'language' => 'en-US',
                'append_to_response' => 'casts'
            ]);

        return $movie;
    }

    public function getMovieSearch($query) : Response
    {
        $movies = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/search/movie', [
                'query' => $query,
                'language' => 'en-US',
                'region' => ''
            ]);

        return $movies;
    }
}
