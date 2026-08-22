<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('/portfolio/{slug}', [ProjectController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[a-z0-9\-\/]+');
