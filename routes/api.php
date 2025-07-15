<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
Route::post('/orders/{id}/products', [OrdersController::class, 'update'])->name('orders.update');
