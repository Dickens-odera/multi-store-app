<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPurchaseController;

Route::view('/','welcome');
//Stores
Route::group(['middleware' => ['auth']], function() {
    //dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    //stores
    Route::resource('stores',StoreController::class)->except([
        'activate',
        'deactivate'
    ]);
    Route::group(['prefix' => 'store', 'as' => 'store.'], function(){
        Route::post('/{id}/activate',[StoreController::class,'activate'])->name('activate');
        Route::post('/{id}/deactivate',[StoreController::class,'deactivate'])->name('deactivate');
    });
    //products
    Route::resource('products', ProductController::class);
    //vehicle types
    Route::resource('vehicle_types',VehicleTypeController::class);
    //drivers
    Route::resource('drivers', DriverController::class);
    //product purchases
    Route::group(['prefix' => 'product', 'as' => 'product.'], function(){
        Route::get('/{id}/puchases',[ProductPurchaseController::class,'purchases'])->name('purchases');
        Route::post('/{id}/purchase',[ProductPurchaseController::class,'purchase'])->name('new_purchase');
    });
});

//auth routes
require __DIR__.'/auth.php';
