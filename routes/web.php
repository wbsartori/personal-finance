<?php

use Illuminate\Support\Facades\Route;

//
//if (env('APP_ENV') && env('APP_PRODUCTION') === 'true') {
//    URL::forceScheme('https');
//}

Route::get('/', function () {
    return view('welcome');
});

