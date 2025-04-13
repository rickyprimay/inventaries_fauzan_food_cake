<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DeliveryController;
use App\Http\Controllers\Dashboard\DeliveryDetailController;
use App\Http\Controllers\Dashboard\DivisionController;
use App\Http\Controllers\Dashboard\OutletController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ReceiveDeliveryController;
use App\Http\Controllers\Dashboard\StokistReportController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login_view'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
  Route::get('/user', [UserController::class, 'index'])->name('user');
  Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
  Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
  Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

  Route::get('/outlet', [OutletController::class, 'index'])->name('outlet');
  Route::post('/outlet/store', [OutletController::class, 'store'])->name('outlet.store');
  Route::put('/outlet/update/{id}', [OutletController::class, 'update'])->name('outlet.update');
  Route::delete('/outlet/delete/{id}', [OutletController::class, 'destroy'])->name('outlet.destroy');

  Route::get('/division', [DivisionController::class, 'index'])->name('division');
  Route::post('/division', [DivisionController::class, 'store'])->name('division.store');
  Route::put('/division/{id}', [DivisionController::class, 'update'])->name('division.update');
  Route::delete('/division/{id}', [DivisionController::class, 'destroy'])->name('division.destroy');

  Route::get('/category', [CategoryController::class, 'index'])->name('category');
  Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
  Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
  Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

  Route::get('/product', [ProductController::class, 'index'])->name('product');
  Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
  Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
  Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

  Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery');
  Route::post('/delivery', [DeliveryController::class, 'store'])->name('delivery.store');
  Route::put('/delivery/{id}', [DeliveryController::class, 'update'])->name('delivery.update');
  Route::delete('/delivery/{id}', [DeliveryController::class, 'destroy'])->name('delivery.destroy');

  Route::get('/receive', [ReceiveDeliveryController::class, 'index'])->name('receive');
  Route::put('/receive/{id}', [ReceiveDeliveryController::class, 'updateStatusToReceived'])->name('receive.update');

  Route::get('/delivery-detail/{id}', [DeliveryDetailController::class, 'index'])->name('delivery.detail');
  Route::post('/delivery-detail/store', [DeliveryDetailController::class, 'store'])->name('delivery.detail.store');
  Route::put('/delivery-detail/{id}', [DeliveryDetailController::class, 'update'])->name('delivery.detail.update');
  Route::delete('/delivery-detail/{id}', [DeliveryDetailController::class, 'destroy'])->name('delivery.detail.destroy');

  Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
  Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
  Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
  Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

  Route::get('/stokist-report', [StokistReportController::class, 'index'])->name('stokist-report');
  Route::post('/stokist-report', [StokistReportController::class, 'store'])->name('stokist-report.store');
  Route::delete('stokist-report/{id}', [StokistReportController::class, 'destroy'])->name('stokist-report.delete');
  Route::get('/stokist-report/{id}', [StokistReportController::class, 'detailStokist'])->name('stokist-report.detail');

});

