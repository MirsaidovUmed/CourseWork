<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
//users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
//orders
Route::get('/orders', [Controllers\OrdersController::class, 'index'])->name('orders.index');
Route::post('/orders', [Controllers\OrdersController::class, 'store'])->name('orders.store');
Route::put('/orders/{id}', [Controllers\OrdersController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [Controllers\OrdersController::class, 'destroy'])->name('orders.destroy');
//products
Route::get('/products', [Controllers\ProductController::class, 'index'])->name('products.index');
Route::post('/products', [Controllers\ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}', [Controllers\ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [Controllers\ProductController::class, 'destroy'])->name('products.destroy');
//reports
Route::get('/reports', [Controllers\ReportsController::class, 'index'])->name('reports.index');
Route::post('/reports', [Controllers\ReportsController::class, 'store'])->name('reports.store');
Route::put('/reports/{id}', [Controllers\ReportsController::class, 'update'])->name('reports.update');
Route::delete('/reports/{id}', [Controllers\ReportsController::class, 'destroy'])->name('reports.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
