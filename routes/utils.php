<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\YajraDatatablesController;

Route::controller(YajraDatatablesController::class)->group(function () {
    
});

Route::controller(AjaxController::class)->group(function () {

});