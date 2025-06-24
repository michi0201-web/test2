<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/register', [ProductsController::class, 'register'])->name('products.create');
Route::post('/products', [ProductsController::class, 'products']);
Route::get('/products', [ProductsController::class, 'list'])->name('products.index');
Route::get('/products/{productId}', [ProductsController::class, 'show'])->name('products.show');
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');
