<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/posts', [PostController::class, 'index']);

// Route::get('/posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');

// Route::get('/posts/create', [PostController::class, 'create']);
// Route::post('/posts', [PostController::class, 'store']);    
// Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->where('id', '[0-9]+');
// Route::put('/posts/{id}', [PostController::class, 'update'])->where('id', '[0-9]+');

Route::resource('posts', PostController::class);