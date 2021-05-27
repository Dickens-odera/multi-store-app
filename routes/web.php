<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\DashboardController;

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
        Route::post('/{id}/deactivate',[StoreController::class,'activate'])->name('deactivate');
    });
});

//auth routes
require __DIR__.'/auth.php';
