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
use App\Http\Controllers\frontend\ProductController as Product;
use App\Http\Controllers\frontend\CartController;


// FRONTEND
Route::get('/', [Frontend::class, 'getIndex']);
Route::get('/about-us', [Frontend::class, 'getAboutUs']);
Route::get('/contact', [Frontend::class, 'getContact']);

Route::group(['prefix' => 'checkout'], function() {
    Route::get('/', [CheckoutController::class, 'getCheckout']);
    Route::get('/complete', [CheckoutController::class, 'getComplete']);
});

Route::group(['prefix' => 'product'], function() {
    Route::get('/', [Product::class, 'getListProducts']);
    Route::get('/detail', [Product::class, 'getDetailProduct']);
});

Route::group(['prefix' => 'cart'], function() {
    Route::get('/', [CartController::class, 'getCart']);
});

// BACKEND
Route::get('/login', [LoginController::class, 'getLogin']);
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');

Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogin'], function() {
    Route::get('/', [IndexController::class, 'Index']);
    
    Route::group(['prefix' => 'category'], function() {
        Route::get('/', [CategoryController::class, 'getCategory']);
        Route::post('/', [CategoryController::class, 'postCategory'])->name('category.add');
        Route::get('/edit/{id}', [CategoryController::class, 'editCategory']);
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', [ProductController::class, 'getListProducts']);
        Route::get('/add', [ProductController::class, 'getAddProduct']);
        Route::get('/edit', [ProductController::class, 'getEditProduct']);
    });

    Route::group(['prefix' => 'variant'], function() {
        Route::get('/add', [VariantController::class, 'getAddVariant']);
        Route::get('/edit', [VariantController::class, 'getEditVariant']);
    });

    Route::group(['prefix' => 'order'], function() {
        Route::get('/', [OrderController::class, 'getOrder']);
        Route::get('/detail', [OrderController::class, 'getDetail']);
        Route::get('/processed', [OrderController::class, 'getProcessed']);
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'getListUsers']);
        Route::get('/add', [UserController::class, 'getAddUser']);
        Route::post('/add', [UserController::class, 'postAddUser'])->name('user.postUser');
        Route::get('/edit/{id}', [UserController::class, 'getEditUser']);
        Route::post('/edit/{id}', [UserController::class, 'postEditUser'])->name('user.editUser');
        Route::get('/delete/{id}', [UserController::class, 'getDeleteUser']);
    });

    Route::group(['prefix' => 'comment'], function() {
        Route::get('/', [CommentController::class, 'getComment']);
        Route::get('/edit', [CommentController::class, 'editComment']);
    });
});
