<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\backend\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::namespace('Api')->group(function() {
    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/show', [UserController::class, 'show']);
    });
});