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
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\frontend\IndexController as Frontend;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\ProductController as ProductFrontend;
use App\Http\Controllers\frontend\CartController;
use App\Livewire\Search;


// FRONTEND
Route::get('/', [Frontend::class, 'getIndex']);
Route::get('/about-us', [Frontend::class, 'getAboutUs']);
Route::get('/contact', [Frontend::class, 'getContact']);
Route::get('/map', [Frontend::class, 'map']);

// Login - Register
Route::get('/login-customer', [Frontend::class, 'loginCustomer'])->middleware('CustomerLogout');
Route::post('/login-customer', [Frontend::class, 'postLoginCustomer'])->name('loginCustomer');
Route::get('/logout-customer', [Frontend::class, 'logoutCustomer']);
Route::get('/register-customer', [Frontend::class, 'registerCustomer']);
Route::post('/register-customer', [Frontend::class, 'postRegisterCustomer'])->name('registerCustomer');
// Login - Google Account
Route::get('auth/google', [Frontend::class, 'authGoogle'])->name('google.login');
Route::get('auth/google/callback', [Frontend::class, 'authGoogleCallback']);

Route::group(['prefix' => 'product'], function() {
    Route::get('/', [ProductFrontend::class, 'getListProducts']);
    Route::get('/detail/{id}', [ProductFrontend::class, 'getDetailProduct']);
});

Route::group(['prefix' => 'cart'], function() {
    Route::get('/', [CartController::class, 'getCart']);
    Route::get('/add-cart', [CartController::class, 'addCart'])->name('addCart');
    Route::post('/get-variant', [CartController::class, 'getVariant'])->name('getVariant');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
    Route::get('/remove/{id}', [CartController::class, 'removeProduct'])->name('removeProduct');
});

Route::group(['prefix' => 'checkout'], function() {
    Route::get('/', [CheckoutController::class, 'getCheckout']);
    Route::post('/', [CheckoutController::class, 'postCheckout'])->name('postCheckout');
    Route::get('/vnpay_payment', [CheckoutController::class, 'getVnPay']);
    Route::post('/vnpay_payment', [CheckoutController::class, 'vnPay'])->name('vnpay_payment');
    Route::get('/momo_payment', [CheckoutController::class, 'getMomoPay']);
    Route::post('/momo_payment', [CheckoutController::class, 'momoPay'])->name('momo_payment');
    Route::get('/complete', [CheckoutController::class, 'getComplete']);

    Route::post('/onepay_method', [CheckoutController::class, 'postOnepay'])->name('postOnepay');
});

Route::get('livewire-user', [Search::class, 'render']);
Route::get('list-users', function() {
    return view('livewire.list-users');
});

// BACKEND
Route::get('/login', [LoginController::class, 'getLogin'])->middleware('CheckLogout')->name('getLogin');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'getLogout']);

Route::group(['prefix' => 'admin', 'middleware' => ['CheckLogin', 'SessionTimeout']], function() {
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
        Route::get('/export-customers', [OrderController::class, 'getCustomers']);
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'getListUsers'])->name('user');
        Route::get('/add', [UserController::class, 'getAddUser']);
        Route::post('/add', [UserController::class, 'postAddUser'])->name('user.postUser');
        Route::get('/edit/{id}', [UserController::class, 'getEditUser']);
        Route::post('/edit/{id}', [UserController::class, 'postEditUser'])->name('user.editUser');
        Route::get('/delete/{id}', [UserController::class, 'getDeleteUser']);
        Route::get('/export-users', [UserController::class, 'exportUsers']);
    });

    Route::group(['prefix' => 'customer'], function() {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('/add', [CustomerController::class, 'getStore']);
        Route::get('/edit/{id}', [CustomerController::class, 'update']);
        Route::post('/edit/{id}', [CustomerController::class, 'postUpdate'])->name('update.customer');
        Route::get('/delete/{id}', [CustomerController::class, 'destroy']);
    });

    Route::group(['prefix' => 'comment'], function() {
        Route::get('/', [CommentController::class, 'getComment']);
        Route::get('/edit', [CommentController::class, 'editComment']);
    });
    
    Route::post('/ask-chatgpt', [ProductController::class, 'askChatGPT'])->name('askChatGPT');
});
