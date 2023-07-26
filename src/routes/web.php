<?php

use Illuminate\Support\Facades\Route;

// AWS ヘルスチェック
Route::get('/health_check', function () {
    echo "vue-sample";
    return response("OK", 200);
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
