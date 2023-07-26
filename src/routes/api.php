<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::pattern('apiVersion1', 'v1');

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => '{apiVersion1}'], function () {
    /*
    * サンプルAPI
    */
    Route::get('/sample/get', 'SampleController@get');

    /*
    * ラインコールバック
    */
    Route::get('/callback/line', 'CallbackController@line');
});
