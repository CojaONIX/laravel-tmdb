<?php

namespace App\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

// https://api.themoviedb.org/3/movie/popular
// https://api.themoviedb.org/3/movie/top_rated
// https://api.themoviedb.org/3/movie/upcoming
// https://api.themoviedb.org/3/movie/now_playing

// https://api.themoviedb.org/3/tv/popular
// https://api.themoviedb.org/3/tv/top_rated
// https://api.themoviedb.org/3/tv/on_the_air
// https://api.themoviedb.org/3/tv/airing_today

class tmdbRepository
{

    public function getGenres($media)
    {
        $response = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . "/genre/$media/list", [
                'language' => 'en-US'
            ]);

        $genres = [];
        foreach ($response['genres'] as $genre)
            $genres[$genre['id']] = $genre['name'];

        return $genres;

    }
    public function getMovieGroup($movieGroup, $page) : Response
    {
        $movies = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/movie/' . $movieGroup, [
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

    public function getTvGroup($tvGroup, $page) : Response
    {
        $tvs = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/tv/' . $tvGroup, [
                'page' => $page,
                'language' => 'en-US',
                'region' => ''
            ]);

        return $tvs;
    }

    public function getTvDetails($tv)
    {
        $tv = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/tv/' . $tv , [
                'language' => 'en-US',
                'append_to_response' => 'casts'
            ]);

        return $tv;
    }

    public function getTvSearch($query) : Response
    {
        $tvs = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/search/tv', [
                'query' => $query,
                'language' => 'en-US',
                'region' => ''
            ]);

        return $tvs;
    }
}
