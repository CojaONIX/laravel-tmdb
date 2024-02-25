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
                return Http::withoutVerifying()
                    ->withToken(env('TMDB_ACCESS_TOKEN'))
                    ->get( env('TMDB_API_URL') . '/genre/movie/list', [
                        'language' => $item
                    ]);

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
