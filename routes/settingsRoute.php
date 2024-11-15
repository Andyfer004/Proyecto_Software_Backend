<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\settingsController;




//rutas del controlador ProfileController

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/settings/{key}', [settingscontroller::class, 'getSettingByKey']);
    Route::post('/settings', [settingsController::class, 'saveSetting']);

});

