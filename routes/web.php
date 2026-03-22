<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlRedirectionController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/{short_code}', [UrlRedirectionController::class, 'originalUrl']);