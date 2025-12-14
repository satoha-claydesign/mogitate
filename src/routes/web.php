<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::get('/search', [ProductController::class, 'search']);
Route::get('/sort', [ProductController::class, 'sort']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::patch('/products/update', [ProductController::class, 'update']);
Route::get('/register', [ProductController::class, 'register']);
Route::post('/store', [ProductController::class, 'store']);
