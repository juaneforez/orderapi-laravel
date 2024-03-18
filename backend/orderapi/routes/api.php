<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CausalController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TypeActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});*/

Route::post('auth/login', [AuthController::class,'login'])->name('auth.login');
Route::post('auth/register', [AuthController::class,'register'])->name('auth.register');

/* Route::middleware('auth:sanctum')->group(function(){ */
    Route::post('auth/logout', [AuthController::class,'logout'])->name('auth.loguot');
    Route::apiResource('causal', CausalController::class);
    Route::apiResource('observation', ObservationController::class);
    Route::apiResource('type_activity', TypeActivityController::class);
    Route::apiResource('technician', TechnicianController::class);
    Route::apiResource('activity', ActivityController::class);
    Route::apiResource('order', OrderController::class);
    Route::get('order/add_activity/{order}/{activity}', [OrderController::class,'add_activity'])->name('order.add_activity');
    Route::get('order/remove_activity/{order}/{activity}', [OrderController::class,'remove_activity'])->name('order.remove_activity');
/* }); */

