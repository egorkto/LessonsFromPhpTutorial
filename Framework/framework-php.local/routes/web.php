<?php

use App\Controllers\HomeController;
use App\Controllers\PostsController;
use Somecode\Framework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostsController::class, 'show']),
];
