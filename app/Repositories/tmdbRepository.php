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

// https://api.themoviedb.org/3/discover/movie?&with_genres=28

class tmdbRepository
{
    private $http;

    public function __construct()
    {
        $this->http = Http::withoutVerifying()->withToken(env('TMDB_ACCESS_TOKEN'));
    }

    public function getMediaDetails(string $media, string $id) : Object
    {
        $params = [
            'language' => 'en-US'
        ];

        if($media == 'movie')
            $params['append_to_response'] = 'casts';

        return json_decode(
            $this->http->get( env('TMDB_API_URL') . "/$media/$id" , $params)
        );
    }

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
                'language' => 'en-US'
            ]);

        return $movies;
    }


    public function getMovieSearch($query) : Response
    {
        $movies = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/search/movie', [
                'query' => $query,
                'language' => 'en-US'
            ]);

        return $movies;
    }

    public function getTvGroup($tvGroup, $page) : Response
    {
        $tvs = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/tv/' . $tvGroup, [
                'page' => $page,
                'language' => 'en-US'
            ]);

        return $tvs;
    }

    public function getTvSearch($query) : Response
    {
        $tvs = Http::withoutVerifying()
            ->withToken(env('TMDB_ACCESS_TOKEN'))
            ->get( env('TMDB_API_URL') . '/search/tv', [
                'query' => $query,
                'language' => 'en-US'
            ]);

        return $tvs;
    }
}
