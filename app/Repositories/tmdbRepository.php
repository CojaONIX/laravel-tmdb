<?php

namespace App\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;

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
    private $url;

    public function __construct()
    {
        $this->http = Http::withoutVerifying()->withToken(env('TMDB_ACCESS_TOKEN'));
        $this->api_url = env('TMDB_API_URL');
    }

    public function getMediaGenres(string $media) : array
    {
        $params = [
            'language' => 'en-US'
        ];

        $response = $this->http->get( $this->api_url . "/genre/$media/list", $params);

        $genres = [];
        foreach ($response['genres'] as $genre)
            $genres[$genre['id']] = $genre['name'];

        return $genres;
    }

    public function getMediaGroup(string $media, string $group, int $page) : Object
    {
        $page = $page ? $page : 1;
        $page =  Number::clamp($page, min: 1, max: 500);

        $params = [
            'language' => 'en-US',
            'page' => $page
        ];

        $items = json_decode($this->http->get( $this->api_url . "/$media/$group", $params));
        $items->genres = $this->getMediaGenres($media);

        return $items;
    }

    public function getMediaDetails(string $media, string $id) : Object
    {
        $params = [
            'language' => 'en-US'
        ];

        if($media == 'movie')
            $params['append_to_response'] = 'casts';

        return json_decode(
            $this->http->get( $this->api_url . "/$media/$id" , $params)
        );
    }



    public function getMediaSearch(string $media, string $query) : Object
    {
        $params = [
            'language' => 'en-US',
            'query' => $query
        ];

        $items = json_decode($this->http->get( $this->api_url . "/search/$media", $params));
        $items->genres = $this->getMediaGenres($media);

        return $items;
    }

}
