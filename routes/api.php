<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TireController;
use App\Http\Controllers\Api\OilController;
use App\Http\Controllers\Api\SparepartController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('tires', TireController::class);
Route::apiResource('oils', OilController::class);
Route::apiResource('spareparts', SparepartController::class);

