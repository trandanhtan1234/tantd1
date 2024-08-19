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
use App\Http\Controllers\frontend\ProductController as ProductFrontend;
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
    Route::get('/', [ProductFrontend::class, 'getListProducts']);
    Route::get('/detail/{id}', [ProductFrontend::class, 'getDetailProduct']);
});

Route::group(['prefix' => 'cart'], function() {
    Route::get('/', [CartController::class, 'getCart']);
    Route::get('/add-cart', [CartController::class, 'addCart'])->name('addCart');
});

// BACKEND
Route::get('/login', [LoginController::class, 'getLogin'])->middleware('CheckLogout');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'getLogout']);

Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogin'], function() {
    Route::get('/', [IndexController::class, 'index']);
    
    Route::group(['prefix' => 'category'], function() {
        Route::get('/', [CategoryController::class, 'getCategory']);
        Route::post('/', [CategoryController::class, 'postCategory'])->name('category.add');
        Route::get('/edit/{id}', [CategoryController::class, 'editCategory']);
        Route::post('/edit/{id}', [CategoryController::class, 'postEditCategory'])->name('category.edit');
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory']);
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', [ProductController::class, 'getListProducts']);
        Route::get('/add', [ProductController::class, 'getAddProduct']);
        Route::post('/add/', [ProductController::class, 'postAddProduct'])->name('addProduct');
        Route::get('/edit/{id}', [ProductController::class, 'getEditProduct']);
        Route::post('/edit/{id}', [ProductController::class, 'postEditProduct'])->name('editProduct');
        Route::get('/delete/{id}', [ProductController::class, 'deleteProduct']);

        Route::get('/attr', [ProductController::class, 'detailAttr']);
        Route::post('/add-attr', [ProductController::class, 'addAttribute'])->name('addAttr');
        Route::get('/edit-attr/{id}', [ProductController::class, 'editAttribute']);
        Route::post('/edit-attr/{id}', [ProductController::class, 'postEditAttribute'])->name('editAttr');
        Route::get('/delete-attr/{id}', [ProductController::class, 'deleteAttribute']);

        Route::post('/add-value', [ProductController::class, 'addValue'])->name('addVal');
        Route::get('/edit-value/{id}', [ProductController::class, 'editValue']);
        Route::post('/edit-value/{id}', [ProductController::class, 'postEditValue'])->name('editValue');
        Route::get('/delete-value/{id}', [ProductController::class, 'deleteValue']);
        
        Route::get('/add-variant/{id}', [ProductController::class, 'getAddVariant']);
        Route::post('/add-variant/{id}', [ProductController::class, 'postAddVariant'])->name('addVariant');
        Route::get('/edit-variant', [ProductController::class, 'getEditVariant']);
    });

    Route::group(['prefix' => 'order'], function() {
        Route::get('/', [OrderController::class, 'getOrder']);
        Route::get('/detail/{id}', [OrderController::class, 'getDetail']);
        Route::post('/detail/{id}', [OrderController::class, 'approveOrder'])->name('approveOrder');
        Route::get('/approved', [OrderController::class, 'getApproved']);
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
