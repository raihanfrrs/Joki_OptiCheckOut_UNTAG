<?php

use App\Http\Controllers\CashierCalculationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportingCashierController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:cashier']], function(){

    Route::controller(InventoryController::class)->group(function () {
        Route::get('inventory/product', 'inventory_product_index')->name('inventory.product.index');
        Route::patch('inventory/product/{product}', 'inventory_product_update')->name('inventory.product.update');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('products/{category}', 'product_index')->name('products.index');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('cart', 'cart_index')->name('cart.index');
        Route::post('cart', 'cart_store')->name('cart.store');
        Route::get('invoice/{transaction}', 'invoice_transaction')->name('invoice');
        Route::get('invoice/{transaction}/print', 'invoice_print')->name('invoice.print');
    });

    Route::controller(ReportingCashierController::class)->group(function () {
        Route::get('cashier/sales-report', 'sales_report_index')->name('sales.report.index');
    });

    Route::controller(CashierCalculationController::class)->group(function () {
        Route::get('cashier/matrik', 'cashier_matrik_index')->name('cashier.matrik.index');
        Route::post('cashier/matrik', 'cashier_matrik_store')->name('cashier.matrik.store');
        Route::patch('cashier/matrik/{alternative_matrik}', 'cashier_matrik_update')->name('cashier.matrik.update');
        Route::delete('cashier/matrik/{alternative_matrik}', 'cashier_matrik_delete')->name('cashier.matrik.delete');

        Route::get('cashier/preference', 'cashier_preference_index')->name('cashier.preference.index');
    });
});