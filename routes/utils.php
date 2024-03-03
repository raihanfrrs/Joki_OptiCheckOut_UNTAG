<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\YajraDatatablesController;

Route::controller(YajraDatatablesController::class)->group(function () {
    Route::get('/listMasterProductTable', 'master_product');
    Route::get('/listMasterCashierTable', 'master_cashier');
    Route::get('/listMasterCategoryTable', 'master_category');
    Route::get('/listInventoryProductTable', 'inventory_product');
    Route::get('/listSalesReportCashierTable', 'sales_report_cashier');
    Route::get('/listDailySalesReportAdminTable', 'sales_report_admin_daily');
    Route::get('/listMonthlySalesReportAdminTable', 'sales_report_admin_monthly');
    Route::get('/listYearlySalesReportAdminTable', 'sales_report_admin_yearly');
    Route::get('/listPerformanceReportAdminTable', 'performance_report_admin');
    Route::get('/listInvoiceAdminTable', 'invoice_admin');
    Route::get('/listAdminActivityTable', 'activity_admin');
    Route::get('/listCashierActivityTable', 'activity_cashier');
});

Route::controller(AjaxController::class)->group(function () {
    Route::get('/ajax/product/{product}/edit', 'product_edit');
    Route::get('/ajax/inventory-product/{product}/edit', 'inventory_product_edit');
    Route::get('/ajax/category/{category}/edit', 'category_edit');
    Route::post('/ajax/deactivate-profile-update', 'deactivate_profile_update');
    Route::post('/ajax/add-to-cart', 'add_to_cart');
    Route::get('/ajax/shopping-cart-count', 'shopping_cart_count');
    Route::post('/ajax/delete-shopping-cart-product', 'shopping_cart_product_delete');
    Route::post('/ajax/update-quantity-shopping-cart-product', 'shopping_cart_product_update_quantity');
    Route::post('/ajax/update-temperature-shopping-cart-product', 'shopping_cart_product_update_temperature');
    Route::post('/ajax/update-size-shopping-cart-product', 'shopping_cart_product_update_size');
    Route::post('/ajax/update-topping-shopping-cart-product', 'shopping_cart_product_update_topping');
});