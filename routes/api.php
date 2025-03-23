<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AirDuctCleaningController;
use App\Http\Controllers\DryerVentCleaningController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('getQuote', [UserController::class, 'getQuote']);
Route::middleware('auth:api')->group( function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::group(['prefix' => 'air-duct-cleaning'], function() {
        Route::get('list', [AirDuctCleaningController::class, 'index']);
        Route::post('add', [AirDuctCleaningController::class, 'store']); 
        Route::post('edit', [AirDuctCleaningController::class, 'update']);
        Route::get('delete/{Id}', [AirDuctCleaningController::class, 'delete']);
    });
    Route::group(['prefix' => 'dryer-vent-cleaning'], function() {
        Route::get('list', [DryerVentCleaningController::class, 'index']);
        Route::post('add', [DryerVentCleaningController::class, 'store']); 
        Route::post('edit', [DryerVentCleaningController::class, 'update']);
        Route::get('delete/{Id}', [DryerVentCleaningController::class, 'delete']);
    });
});
