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
            'Popular',
            'Genres',
            'Authorization',

        ]]);
    }

    public function ajaxGetTestData(Request $request)
    {
        $item = $request->item;
        switch($request->action) {

            case('Popular'):

                return Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/movie/popular', [
                        'page' => $item,
                        'language' => 'en-US',
                        'region' => ''
                    ]);

            case('Genres'):
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