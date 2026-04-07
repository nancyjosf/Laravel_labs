<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('posts.show');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->where('id', '[0-9]+')->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->where('id', '[0-9]+')->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->where('id', '[0-9]+')->name('posts.destroy');
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->where('id', '[0-9]+')->name('posts.restore');
