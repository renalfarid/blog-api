<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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
       //
    });
}); 