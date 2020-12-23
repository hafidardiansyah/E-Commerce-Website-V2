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

Route::get('/', [ProductController::class, 'index']);
Route::get('/detail/{product:slug}', [ProductController::class, 'show']);
Route::get('/list-product/search', [ProductController::class, 'search'])->name('search');
Route::get('/list-product', [ProductController::class, 'list_product'])->name('list-product');


Auth::routes();

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');

    Route::get('{product:slug}/edit', [ProductController::class, 'edit']);
    Route::patch('{product:slug}/update', [ProductController::class, 'update']);

    Route::delete('{product:slug}/delete', [ProductController::class, 'delete']);
});
