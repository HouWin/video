<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    //
    public static function update()
    {
        $token=Str::random(60);
        $user=Auth::user();
        $user->api_token=$token;
        $user->save();
        return ['token'=>$token];
    }
}
