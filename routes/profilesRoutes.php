<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;




//rutas del controlador ProfileController
 Route::post('/profiles', [ProfileController::class, 'addProfile']);
 Route::put('/profiles/{id}', [ProfileController::class, 'updateProfile']);
 Route::delete('/profiles/{id}', [ProfileController::class, 'deleteProfile']);
 Route::get('/profiles/{id}', [ProfileController::class, 'getProfile']);
 Route::get('/profiles', [ProfileController::class, 'getProfiles']);
 Route::post('/profiles/assign', [ProfileController::class, 'assignProfileToUser']);


