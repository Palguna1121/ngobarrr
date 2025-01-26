<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1')->group(function () {
    //get all data post
    Route::get('/posts', [PostsController::class, 'index']);
    //mengirim data ke database
    Route::post('/posts', [PostsController::class, 'store']);
    //mengambil data berdasarkan id
    Route::get('post/{id}', [PostsController::class, 'show']);
    //mengupdate data berdasarkan id
    Route::put('post/{id}/update', [PostsController::class, 'update']);
    //menghapus data berdasarkan id
    Route::delete('post/{id}/delete', [PostsController::class, 'destroy']);
});
