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
            'test1',
            'test2',

        ]]);
    }

    public function ajaxGetTestData(Request $request)
    {
        $item = $request->item;
        switch($request->action) {

            case('test1'):
                return "test1";

            case('test2'):
                return 'test2';



            default:
                return [
                    'msg' => 'Bad action'
                ];
        }

    }
}
