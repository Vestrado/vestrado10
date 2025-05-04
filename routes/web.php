<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\storeController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminController;

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
// Route::get('/tradedetails-{id}', [loginController::class, 'details'])->name('trades.details');
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
Route::post('/cart/add', [cartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [cartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart2', [cartController::class, 'cartaddress'])->name('cart.address');
Route::post('/checkout', [cartController::class, 'cartreview'])->name('cart.review');
Route::post('/chkprocess', [cartController::class, 'processCheckout'])->name('checkout.process');


//order
Route::get('/orderhistory', [orderController::class, 'index'])->name('order.history');
Route::get('/order-{orderid}', [orderController::class, 'orderview'])->name('order.detail');

//Admin
// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
//     Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
//     // Add a dashboard route if needed
//     Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
// });


// Route::get('/products/create2', [AdminProductController::class, 'create'])->middleware('admin')->name('admin.products.create');
// Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
// Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

// Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login']);
// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');

// Admin routes group
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/list', [AdminProductController::class, 'listing'])->name('admin.products.listing');
});

// Admin login routes (no admin middleware, as they are for unauthenticated users)
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);


