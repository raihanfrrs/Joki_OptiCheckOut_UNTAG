<?php

use App\Http\Controllers\MasterAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:admin']], function(){

    Route::controller(MasterAdminController::class)->group(function () {
        Route::get('master/cashier', 'master_cashier_index')->name('master.cashier.index');
        Route::get('master/cashier/add', 'master_cashier_create');
        Route::post('master/cashier', 'master_cashier_store')->name('master.cashier.store');
        Route::patch('master/cashier/{cashier}', 'master_product_update')->name('master.product.update');
        Route::delete('master/product/{product}', 'master_product_destroy')->name('master.product.destroy');
        Route::patch('master/product/{product}/status', 'master_product_update_status')->name('master.product.update.status');

        Route::get('master/product', 'master_product_index')->name('master.product.index');
        Route::post('master/product', 'master_product_store')->name('master.product.store');
        Route::patch('master/product/{product}', 'master_product_update')->name('master.product.update');
        Route::delete('master/product/{product}', 'master_product_destroy')->name('master.product.destroy');
        Route::patch('master/product/{product}/status', 'master_product_update_status')->name('master.product.update.status');
    });

});
