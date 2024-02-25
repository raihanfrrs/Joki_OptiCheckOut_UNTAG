<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\YajraDatatablesController;

Route::controller(YajraDatatablesController::class)->group(function () {
    Route::get('/listMasterProductTable', 'master_product');
    Route::get('/listMasterCashierTable', 'master_cashier');
});

Route::controller(AjaxController::class)->group(function () {
    Route::get('/ajax/product/{product}/edit', 'product_edit');
});