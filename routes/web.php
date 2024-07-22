<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\IndexController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CommentController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\VariantController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\IndexController as Frontend;
use App\Http\Controllers\frontend\CheckoutController;


// FRONTEND
Route::get('/', [Frontend::class, 'getIndex']);
Route::get('/about-us', [Frontend::class, 'getAboutUs']);
Route::get('/contact', [Frontend::class, 'getContact']);

Route::group(['prefix' => 'checkout'], function() {
    Route::get('/', [CheckoutController::class, 'getCheckout']);
});

// BACKEND
Route::get('/login', [LoginController::class, 'getLogin']);

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [IndexController::class, 'Index']);
    
    Route::group(['prefix' => 'category'], function() {
        Route::get('/', [CategoryController::class, 'getCategory']);
        Route::get('/edit', [CategoryController::class, 'editCategory']);
    });

    Route::group(['prefix' => 'comment'], function() {
        Route::get('/', [CommentController::class, 'getComment']);
        Route::get('/edit', [CommentController::class, 'editComment']);
    });

    Route::group(['prefix' => 'order'], function() {
        Route::get('/', [OrderController::class, 'getOrder']);
        Route::get('/detail', [OrderController::class, 'getDetail']);
        Route::get('/processed', [OrderController::class, 'getProcessed']);
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', [ProductController::class, 'getListProducts']);
        Route::get('/add', [ProductController::class, 'getAddProduct']);
        Route::get('/edit', [ProductController::class, 'getEditProduct']);
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'getListUsers']);
        Route::get('/add', [UserController::class, 'getAddUser']);
        Route::get('/edit', [UserController::class, 'getEditUser']);
    });

    Route::group(['prefix' => 'variant'], function() {
        Route::get('/add', [VariantController::class, 'getAddVariant']);
        Route::get('/edit', [VariantController::class, 'getEditVariant']);
    });
});
