<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    //rutas del controlador ProfileController
    Route::post('/profiles', [ProfileController::class, 'addProfile']);
    Route::put('/profiles/{id}', [ProfileController::class, 'updateProfile']);
    Route::delete('/profiles/{id}', [ProfileController::class, 'deleteProfile']);
    Route::get('/profiles/{id}', [ProfileController::class, 'getProfile']);
    Route::get('/profiles', [ProfileController::class, 'getProfiles']);


Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');

});

Route::get('/not_auth', function () {
    return response()->json(['message' => 'not authenticated'], 200);
});