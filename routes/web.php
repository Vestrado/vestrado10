<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\loginController;

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
Route::get('/store', [loginController::class, 'store'])->name('store');
Route::get('/', [loginController::class, 'store'])->name('store');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/tradedetails-{id}', [loginController::class, 'details'])->name('trades.details');
