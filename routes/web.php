<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController};

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
Route::get('/detail/{product:slug}', [ProductController::class, 'show']);
// search product
Route::get('/list-product/search', [ProductController::class, 'search'])->name('search');
// list product
Route::get('/list-product', [ProductController::class, 'list_product'])->name('list-product');

Auth::routes();

Route::middleware(['auth', 'role'])->group(function () {
    // create and save product
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');

    // edit and update product
    Route::get('{product:slug}/edit', [ProductController::class, 'edit']);
    Route::patch('{product:slug}/update', [ProductController::class, 'update']);

    // delete product
    Route::delete('{product:slug}/delete', [ProductController::class, 'delete']);
});

Route::middleware('auth')->group(function () {
    // add product to cart
    Route::post('add', [ProductController::class, 'add'])->name('add');

    // list cart
    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
});
