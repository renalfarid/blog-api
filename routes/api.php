<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikeDislikeController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\UsersController;

Route::get('/', function (){
   return response()->json(["message" => "welcome API"]);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'auth'])->name('login');
    Route::post('signup', [AuthController::class, 'signup']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('users', [AuthController::class, 'getUsers']);
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('/', [UsersController::class, 'getUserDetails']);
        Route::get('/posts', [PostsController::class, 'getUserPost']);
        Route::put('/posts/{id}', [PostsController::class, 'updateUserPost']);
        Route::post('/posts', [PostsController::class, 'createUserPost']);
        Route::delete('/posts/{id}', [PostsController::class, 'deleteUserPost']);

        Route::post('/comments/{id}', [CommentsController::class, 'createPostComment']);
        Route::get('/comments/{id}', [CommentsController::class, 'getPostComment']);
        Route::put('/comments/{id}', [CommentsController::class, 'updatePostComment']);
        Route::delete('/comments/{id}', [CommentsController::class, 'deletePostComment']);

        Route::post('/like/posts/{id}', [LikeDislikeController::class, 'addLikePost']);
        Route::post('/like/comments/{id}', [LikeDislikeController::class, 'addLikeComment']);

        Route::post('/dislike/posts/{id}', [LikeDislikeController::class, 'addDislikePost']);
        Route::post('/dislike/comments/{id}', [LikeDislikeController::class, 'addDislikeComment']);
    });
}); 

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostsController::class, 'getPosts']);
    Route::get('/filter', [PostsController::class, 'getFilterPosts']);
    Route::get('/comments/{id}', [CommentsController::class, 'getPostComment']);
}); 
