<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\storeController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\orderController;

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

// Route::get('/', function () {
//     //return view('store');
//     Route::get('/', [loginController::class, 'store'])->name('store');
// });

//Route::get('/test', [testController::class, 'index'])->name('test');
Route::get('/home', [loginController::class, 'index'])->name('login');
Route::post('/loginprocess', [loginController::class, 'loginprocess'])->name('login.process');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

//store
Route::get('/store', [loginController::class, 'store'])->name('store');
Route::get('/', [loginController::class, 'store'])->name('store');
Route::get('/product-{id}', [storeController::class, 'index'])->name('product.detail');

//cart
Route::get('/cart', [cartController::class, 'index'])->name('cart.index');

//order
Route::get('/orderhistory', [orderController::class, 'history'])->name('order.history');

Route::get('/tradedetails-{id}', [loginController::class, 'details'])->name('trades.details');
