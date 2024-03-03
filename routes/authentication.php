<?php

use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

Route::controller(LayoutController::class)->group(function () {
    Route::get('/', 'index')->name('/');
});

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('sign-in', 'cashier')->name('login.cashier');
        Route::get('/admin-001-login', 'admin');
        Route::post('sign-in/{level}', 'store')->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(LogoutController::class)->group(function () {
        Route::get('sign-out', 'index')->name('logout');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::get('teams', 'teams')->name('teams');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings/profile', 'settings_profile_index')->name('settings.profile');
        Route::patch('settings/profile', 'settings_profile_update')->name('settings.profile.update');

        Route::get('settings/account', 'settings_account_index')->name('settings.account');
        Route::patch('settings/account', 'settings_account_update')->name('settings.account.update');
    });
    
});

Route::controller(ErrorController::class)->group(function () {
    Route::get('404', 'not_found')->name('404');
    Route::get('403', 'not_authorized')->name('403');
});