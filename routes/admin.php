<?php

use App\Http\Controllers\AdminCalculationController;
use App\Http\Controllers\MasterAdminController;
use App\Http\Controllers\ReportingAdminController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:admin']], function(){

    Route::controller(MasterAdminController::class)->group(function () {
        Route::get('master/cashier', 'master_cashier_index')->name('master.cashier.index');
        Route::get('master/cashier/add', 'master_cashier_create');
        Route::post('master/cashier', 'master_cashier_store')->name('master.cashier.store');
        Route::get('master/cashier/{cashier}/edit', 'master_cashier_edit')->name('master.cashier.edit');
        Route::patch('master/cashier/{cashier}', 'master_cashier_update')->name('master.cashier.update');
        Route::delete('master/cashier/{cashier}', 'master_cashier_destroy')->name('master.cashier.destroy');
        Route::patch('master/cashier/{cashier}/status', 'master_cashier_update_status')->name('master.cashier.update.status');
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

    Route::controller(ReportingAdminController::class)->group(function () {
        Route::get('admin/sales-report/daily', 'admin_sales_report_daily')->name('admin.sales.report.daily');
        Route::get('admin/sales-report-print/daily/{day}', 'admin_sales_report_daily_print')->name('admin.sales.report.daily.print');

        Route::get('admin/sales-report/monthly', 'admin_sales_report_monthly')->name('admin.sales.report.monthly');
        Route::get('admin/sales-report-print/monthly/{month}', 'admin_sales_report_monthly_print')->name('admin.sales.report.monthly.print');

        Route::get('admin/sales-report/yearly', 'admin_sales_report_yearly')->name('admin.sales.report.yearly');
        Route::get('admin/sales-report-print/yearly/{year}', 'admin_sales_report_yearly_print')->name('admin.sales.report.yearly.print');

        Route::get('admin/performance-report', 'admin_performance_report')->name('admin.performance.report');

        Route::get('admin/invoice', 'admin_invoice')->name('admin.invoice');
        Route::get('admin/invoice/{transaction}', 'admin_invoice_show')->name('admin.invoice.show');
        Route::get('admin/invoice/{transaction}/print', 'admin_invoice_print')->name('admin.invoice.print');
    });

    Route::controller(AdminCalculationController::class)->group(function () {
        Route::get('admin/matrik', 'admin_matrik_index')->name('admin.matrik.index');
        Route::post('admin/matrik', 'admin_matrik_store')->name('admin.matrik.store');
        Route::patch('admin/matrik/{alternative_matrik}', 'admin_matrik_update')->name('admin.matrik.update');
        Route::delete('admin/matrik/{alternative_matrik}', 'admin_matrik_delete')->name('admin.matrik.delete');

        Route::get('admin/preference', 'admin_preference_index')->name('admin.preference.index');
    });

    Route::controller(TrashController::class)->group(function () {
        Route::get('trash/cashier', 'trash_index')->name('trash.cashier.index');
        Route::patch('trash/cashier/{cashier}', 'trash_cashier_update')->name('trash.cashier.update');
        Route::delete('trash/cashier/{cashier}', 'trash_cashier_destroy')->name('trash.cashier.destroy');

        Route::get('trash/product', 'trash_index')->name('trash.product.index');
        Route::patch('trash/product/{product}', 'trash_product_update')->name('trash.product.update');
        Route::delete('trash/product/{product}', 'trash_product_destroy')->name('trash.product.destroy');

        Route::get('trash/category', 'trash_index')->name('trash.category.index');
        Route::patch('trash/category/{category}', 'trash_category_update')->name('trash.category.update');
        Route::delete('trash/category/{category}', 'trash_category_destroy')->name('trash.category.destroy');
    });
});