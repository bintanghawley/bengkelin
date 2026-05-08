<?php

use App\Http\Controllers\Api\ControllerAPI;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', ControllerAPI::class);
