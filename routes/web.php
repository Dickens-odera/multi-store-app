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
        Route::get('/client/purchases',[ProductPurchaseController::Class,'myPurchases'])->name('personal_purchases');
    });
    //promotiional emails to customers
    Route::group(['prefix' => 'promotions', 'as' => 'promotions.'], function(){
        Route::post('/{id}/send-mail',[ProductPurchaseController::class,'sendMail'])->name('send_mail');
    });
    Route::resource('roles',RoleController::class);
});

//auth routes
require __DIR__.'/auth.php';
