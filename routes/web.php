<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoreController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','welcome');

Route::get('/dashboard', function () {
    return view('template.index'); //dashboard
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Stores
Route::group(['middleware' => 'auth'], function() {
    Route::resource('stores',StoreController::class)->except([
        'activate',
        'deactivate'
    ]);
    Route::group(['prefix' => 'store', 'as' => 'store.'], function(){
        Route::post('/{id}/activate',[StoreController::class,'activate'])->name('activate');
        Route::post('/{id}/deactivate',[StoreController::class,'activate'])->name('deactivate');
    });
});
