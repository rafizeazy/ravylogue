<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::get('/posts', action: [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', action: [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', action: [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', action: [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', action: [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', action: [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', action: [PostController::class, 'destroy'])->name('posts.destroy');

Route::resource('posts', PostController::class);
Route::get('/search', [PostController::class, 'search'])->name('posts.search');

Route::resource('tags', TagController::class)->except(['show']);
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rute untuk Comments
Route::middleware('auth')->group(function () {
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('posts/{post}/like', [PostLikeController::class, 'store'])->name('posts.like');
});


require __DIR__ . '/auth.php';
