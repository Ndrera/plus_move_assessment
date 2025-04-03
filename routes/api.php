<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/couriers/{id}', [App\Http\Controllers\ApiController::class, 'getAllCouriers'])->name('couriers');
Route::post('/courier/store', [App\Http\Controllers\ApiController::class, 'createCourier'])->name('store');
Route::get('/courier/{id}', [App\Http\Controllers\ApiController::class, 'getCourier'])->name('courier');
Route::put('/courier/update', [App\Http\Controllers\ApiController::class, 'updateCourier'])->name('update');
Route::delete('/courier/delete', [App\Http\Controllers\ApiController::class, 'deleteCourier'])->name('delete');


