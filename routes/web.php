<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController, CartController, CategoryController, OrderController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home
Route::get('/', [ProductController::class, 'index']);
// detail product
Route::get('detail/{product:slug}', [ProductController::class, 'detail']);
// search product
Route::get('products/search', [ProductController::class, 'search'])->name('search');
// list product
Route::get('products', [ProductController::class, 'products'])->name('products');

Auth::routes();

// for admin
Route::prefix('product')->middleware(['auth', 'admin'])->group(function () {
    // create and save product
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('save', [ProductController::class, 'save'])->name('save');

    // edit and update product
    Route::get('{product:slug}/edit', [ProductController::class, 'edit']);
    Route::patch('{product:slug}/update', [ProductController::class, 'update']);

    // delete product
    Route::delete('{product:slug}/delete', [ProductController::class, 'delete']);
});

// list cart
Route::get('cart', [CartController::class, 'cart'])->middleware(['auth', 'user'])->name('cart');

// for user
Route::prefix('cart')->middleware(['auth', 'user'])->group(function () {
    // add product to cart
    Route::post('add', [CartController::class, 'add'])->name('add');

    // delete product in cart
    Route::delete('{cart_id:slug}/delete', [CartController::class, 'delete']);

    // checkout
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');

    // plus
    Route::post('{cart_id:slug}/plus', [CartController::class, 'plus']);

    // minus
    Route::post('{cart_id:slug}/minus', [CartController::class, 'minus']);
});

Route::prefix('order')->middleware(['auth', 'user'])->group(function () {
    // order now
    Route::post('order', [OrderController::class, 'order'])->name('order');

    // Order
    Route::get('my-order', [OrderController::class, 'my_order'])->name('my-order');
});

// category
Route::get('products/{category:slug}', [CategoryController::class, 'category']);
