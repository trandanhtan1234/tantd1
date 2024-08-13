<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\backend\UserController;
use App\Http\Controllers\Api\backend\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::namespace('Api')->group(function() {
    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/show', [UserController::class, 'show']);
        Route::post('/store/{id}', [UserController::class, 'store']);
        Route::get('/destroy/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/show/{id}', [CategoryController::class, 'show']);
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy']);
    });
});