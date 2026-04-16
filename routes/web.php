<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::patch('posts/{post}/restore', [PostController::class, 'restore'])
    ->middleware('auth')
    ->name('posts.restore');

Route::delete('posts/{post}/force-delete', [PostController::class, 'forceDelete'])
    ->middleware('auth')
    ->name('posts.forceDelete');

Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])
    ->middleware('auth')
    ->name('posts.comments.store');

Route::resource('posts', PostController::class)->middleware('auth');