<?php

use App\Http\Controllers\MasterAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:admin']], function(){

    Route::controller(MasterAdminController::class)->group(function () {
        Route::get('master/cashier', 'master_cashier_index')->name('master.cashier.index');
        Route::get('master/cashier/add', 'master_cashier_create');
        Route::post('master/cashier', 'master_cashier_store')->name('master.cashier.store');
        Route::get('master/cashier/{cashier}/edit', 'master_cashier_edit')->name('master.cashier.edit');
        Route::patch('master/cashier/{cashier}', 'master_cashier_update')->name('master.cashier.update');
        Route::delete('master/product/{cashier}', 'master_cashier_destroy')->name('master.cashier.destroy');
        Route::patch('master/product/{cashier}/status', 'master_cashier_update_status')->name('master.cashier.update.status');
        Route::get('master/cashier/{cashier}', 'master_cashier_show')->name('master.cashier.show');

        Route::get('master/product', 'master_product_index')->name('master.product.index');
        Route::post('master/product', 'master_product_store')->name('master.product.store');
        Route::patch('master/product/{product}', 'master_product_update')->name('master.product.update');
        Route::delete('master/product/{product}', 'master_product_destroy')->name('master.product.destroy');
        Route::patch('master/product/{product}/status', 'master_product_update_status')->name('master.product.update.status');
        
        Route::get('master/category', 'master_category_index')->name('master.category.index');
        Route::post('master/category', 'master_category_store')->name('master.category.store');
        Route::patch('master/category/{category}', 'master_category_update')->name('master.category.update');
        Route::delete('master/category/{category}', 'master_category_destroy')->name('master.category.destroy');
        Route::patch('master/category/{category}/status', 'master_category_update_status')->name('master.category.update.status');
    });

});
