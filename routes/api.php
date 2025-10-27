<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\LinkController;

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {

    Route::controller(LinkController::class)->group(function () {
        Route::post('/make-short-url', 'makeShortLink');
        Route::get('/statistic/{short_code}', 'getLinkStatistic');
    });
});