<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:cashier']], function(){

    Route::controller(InventoryController::class)->group(function () {
        Route::get('inventory/product', 'inventory_product_index')->name('inventory.product.index');
        Route::patch('inventory/product/{product}', 'inventory_product_update')->name('inventory.product.update');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'product_index')->name('products.index');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('cart', 'cart_index')->name('cart.index');
    });

});