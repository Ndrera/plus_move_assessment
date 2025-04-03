<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes([ 'register' => false]);
Auth::routes();

####
# Admin
#
Route::group([ 'as' => 'admin.', 'prefix'=> 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin'] ], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/courier', [App\Http\Controllers\CourierController::class, 'index'])->name('courier');
    Route::post('/courier/store', [App\Http\Controllers\CourierController::class, 'store'])->name('store');
    Route::get('/shippings', [App\Http\Controllers\CourierController::class, 'shippings'])->name('shippings');
    Route::get('/shipping/status/{id}', [App\Http\Controllers\CourierController::class, 'getShippingByStatus'])->name('shipping-status');
    Route::get('/shipping/show/{id}', [App\Http\Controllers\CourierController::class, 'show'])->name('show');
    Route::post('/shipping/edit', [App\Http\Controllers\CourierController::class, 'update'])->name('edit');
    Route::post('/shipping/delete', [App\Http\Controllers\CourierController::class, 'destroy'])->name('delete');
    Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles');
    Route::post('/vehicle/add', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicle-add');
    Route::get('/vehicle/delete/{id}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicle-delete');
});


####
# Warehouse
#
Route::group([ 'as' => 'warehouse.', 'prefix'=> 'warehouse', 'namespace' => 'Warehouse', 'middleware' => ['auth', 'warehouse'] ], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/shipping/status/{id}', [App\Http\Controllers\CourierController::class, 'getShippingByStatus'])->name('shipping-status');
    Route::get('/shipping/show/{id}', [App\Http\Controllers\CourierController::class, 'show'])->name('show');
    Route::post('/shipping/edit', [App\Http\Controllers\CourierController::class, 'update'])->name('edit');
    Route::post('/shipping/delete', [App\Http\Controllers\CourierController::class, 'destroy'])->name('delete');
});


####
# Driver
#
Route::group([ 'as' => 'driver.', 'prefix'=> 'driver', 'namespace' => 'Driver', 'middleware' => ['auth', 'driver'] ], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/courier', [App\Http\Controllers\CourierController::class, 'index'])->name('courier');
    Route::post('/courier/store', [App\Http\Controllers\CourierController::class, 'store'])->name('store');
    Route::get('/shipping/status/{id}', [App\Http\Controllers\CourierController::class, 'getShippingByStatus'])->name('shipping-status');
    Route::get('/shipping/show/{id}', [App\Http\Controllers\CourierController::class, 'show'])->name('show');
    Route::post('/shipping/edit', [App\Http\Controllers\CourierController::class, 'update'])->name('edit');
    Route::post('/shipping/delete', [App\Http\Controllers\CourierController::class, 'destroy'])->name('delete');
});


####
# Scheduled in a cron job. To process all the packages not delivered on that day.
# Runs daily at 5pm.
#
Route::get('/return', [App\Http\Controllers\CourierController::class, 'return'])->name('return');

