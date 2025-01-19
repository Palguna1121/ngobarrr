<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post', [PostsController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostsController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostsController::class, 'store'])->name('post.store');
Route::get('/post/{postinganId}', [PostsController::class, 'show'])->name('post.show');
Route::get('/post/{id}/edit', [PostsController::class, 'edit'])->name('post.edit');
Route::put('/post/{id}/update', [PostsController::class, 'update'])->name('post.update');
Route::delete('/post/{id}/delete', [PostsController::class, 'destroy'])->name('post.destroy');
