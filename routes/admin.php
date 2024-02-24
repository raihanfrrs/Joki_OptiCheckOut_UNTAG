<?php

use App\Http\Controllers\MasterAdminController;
use Illuminate\Support\Facades\Route;

Route::controller(MasterAdminController::class)->group(function () {
    Route::get('master/product', 'master_product_index')->name('master.product.index');
});
