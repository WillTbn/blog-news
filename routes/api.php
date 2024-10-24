<?php

use App\Http\Controllers\Api\BlogNewsApiController;
use App\Http\Controllers\Api\CommentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/blog', [BlogNewsApiController::class, 'getAll'])->name('blog.getAll');
Route::get('/blog/lastet', [BlogNewsApiController::class, 'getLast'])->name('blog.getLast');
Route::get('/blog/{blogNew:hash_id}', [BlogNewsApiController::class, 'getOne'])->name('blog.getOne');
Route::post('/comment', [CommentApiController::class, 'store'])->name('comment.store');
