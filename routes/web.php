<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/users', [Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/users', [Controllers\UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [Controllers\UserController::class, 'destroy'])->name('users.destroy');
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
//mediaPlans
Route::get('/media_plans', [Controllers\MediaPlansController::class, 'index'])->name('media_plans.index');
Route::post('/media_plans', [Controllers\MediaPlansController::class, 'store'])->name('media_plans.store');
Route::put('/media_plans/{id}', [Controllers\MediaPlansController::class, 'update'])->name('media_plans.update');
Route::delete('/media_plans/{id}', [Controllers\MediaPlansController::class, 'destroy'])->name('media_plans.destroy');

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');
