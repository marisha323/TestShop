<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/add-order', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect('/category');
});
Route::get('/category', function () {
    return view('category');
});
Route::get('/category',[ProductController::class,"index"]);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/add-to-cart', [ProductController::class, 'basket']);
Route::get('/show-basket', [ProductController::class, 'show_basket']);
Route::post('/store-order', [ProductController::class, 'store_order']);
