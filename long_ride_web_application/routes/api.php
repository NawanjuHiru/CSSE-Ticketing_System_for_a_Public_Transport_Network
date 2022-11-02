<?php

use App\Http\Controllers\InspectorApiController;
use App\Http\Controllers\RouteApiController;
use App\Http\Controllers\PaymentApiController;
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

Route::get('/getPassenger',[InspectorApiController::class, 'getAllPassengers']);
Route::get('/getRoutes',[RouteApiController::class, 'getAllRoutes']);
Route::get('/getSinglePassenger',[InspectorApiController::class, 'getSinglePassenger']);
Route::post('/postReload',[PaymentApiController::class, 'reload']);
