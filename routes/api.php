<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\backend\UserController;
use App\Http\Controllers\Api\backend\CategoryController;
use App\Http\Controllers\Api\backend\ProductController;
use App\Http\Controllers\Api\backend\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::namespace('api')->group(function() {
    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/store', [UserController::class, 'store']);
        Route::get('/show/{id}', [UserController::class, 'show']);
        Route::post('/update/{id}', [UserController::class, 'update']);
        Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::get('/show/{id}', [CategoryController::class, 'show']);
        Route::post('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('product')->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/show/{id}', [ProductController::class, 'show']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/show/{id}', [OrderController::class, 'show']);
        Route::post('/update/{id}', [OrderController::class, 'update']);
    });
});