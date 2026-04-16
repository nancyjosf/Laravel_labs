<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->where('id', '[0-9]+')->name('posts.restore');
Route::delete('/posts/{id}/force', [PostController::class, 'forceDelete'])->where('id', '[0-9]+')->name('posts.forceDelete');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('posts.show');

Route::post('/posts/{id}/comments', [PostController::class, 'storeComment'])->where('id', '[0-9]+')->name('posts.comments.store');

Route::resource('posts', PostController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);