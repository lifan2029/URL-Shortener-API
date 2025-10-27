<?php

use App\Http\Controllers\Api\v1\LinkController;
use Illuminate\Support\Facades\Route;

Route::controller(LinkController::class)->group(function () {
    Route::get('/{short_code}', 'redirectFromShortLink');
});