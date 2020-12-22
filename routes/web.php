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

Auth::routes();

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');

    // Route::get('{post:slug}/edit', [PostController::class, 'edit']);
    // Route::patch('{post:slug}/update', [PostController::class, 'update']);

    // Route::delete('{post:slug}/delete', [PostController::class, 'delete']);
});
