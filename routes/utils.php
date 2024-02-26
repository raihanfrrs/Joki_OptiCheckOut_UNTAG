<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\YajraDatatablesController;

Route::controller(YajraDatatablesController::class)->group(function () {
    Route::get('/listMasterProductTable', 'master_product');
    Route::get('/listMasterCashierTable', 'master_cashier');
    Route::get('/listMasterCategoryTable', 'master_category');
    Route::get('/listInventoryProductTable', 'inventory_product');
});

Route::controller(AjaxController::class)->group(function () {
    Route::get('/ajax/product/{product}/edit', 'product_edit');
    Route::get('/ajax/inventory-product/{product}/edit', 'inventory_product_edit');
    Route::get('/ajax/category/{category}/edit', 'category_edit');
    Route::post('/ajax/deactivate-profile-update', 'deactivate_profile_update');
});