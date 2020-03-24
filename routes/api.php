<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','PublicController@login');


Route::middleware('auth:api')->group(function(){
    Route::post('/createUser','PublicController@createUser');
    Route::get('/logout','PublicController@logout');
    Route::get('/h',function (){
        echo 111;exit;
    });
    Route::resource('task','TaskController');
});

