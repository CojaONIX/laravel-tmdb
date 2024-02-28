<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use Throwable;

class TestController extends Controller
{
    public function showTest(Request $request)
    {
        return view('test', ['buttons' => [
            'tvDetails',
            'tvPopular',
            'tvGenres',
            'movieDetails',
            'moviePopular',
            'movieGenres',
            'Authorization',

        ]]);
    }

    public function ajaxGetTestData(Request $request)
    {
        $item = $request->item;
        switch($request->action) {

            case('tvDetails'):
                $movie = Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/tv/' . $item , [
                        'language' => 'en-US'
                    ]);

                return $movie;

            case('tvPopular'):

                return Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/tv/popular', [
                        'page' => $item,
                        'language' => 'en-US',
                        'region' => ''
                    ]);

            case('tvGenres'):
                $genres = Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/genre/tv/list', [
                        'language' => $item
                    ]);

                $inputArray = $genres['genres'];
                $ids = array_column($inputArray, 'id');
                $names = array_column($inputArray, 'name');

                $resultArray = array_combine($ids, $names);

                return $resultArray;

            case('movieDetails'):
                $movie = Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/movie/' . $item , [
                        'language' => 'en-US',
                        'append_to_response' => 'casts'
                    ]);

                return $movie;

            case('moviePopular'):

                return Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/movie/popular', [
                        'page' => $item,
                        'language' => 'en-US',
                        'region' => ''
                    ]);

            case('movieGenres'):
                $genres = Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/genre/movie/list', [
                        'language' => $item
                    ]);

                $inputArray = $genres['genres'];
                $ids = array_column($inputArray, 'id');
                $names = array_column($inputArray, 'name');

                $resultArray = array_combine($ids, $names);

                return $resultArray;

            case('Authorization'):
                return Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/authentication');

//                return Http::withoutVerifying()->get( env('TMDB_API_URL') . '/authentication', [
//                    'api_key' => env('TMDB_API_KEY')
//                ]);



            default:
                return [
                    'msg' => 'Bad action'
                ];
        }

    }
}
