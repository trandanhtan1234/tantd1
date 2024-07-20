<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\IndexController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CommentController;

Route::get('/login', [LoginController::class, 'getLogin']);

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [IndexController::class, 'Index']);
    
    Route::group(['prefix' => 'category'], function() {
        Route::get('/', [CategoryController::class, 'getCategory']);
        Route::get('/edit', [CategoryController::class, 'editCategory']);
    });

    Route::group(['prefix' => 'comment'], function() {
        Route::get('/', [CommentController::class, 'getComment']);
    });
    // abc
});
