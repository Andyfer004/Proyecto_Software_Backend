<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::get('events', [EventController::class, 'index']);
    Route::get('events/{id}', [EventController::class, 'show']);
    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{id}', [EventController::class, 'update']);
    Route::delete('events/{id}', [EventController::class, 'destroy']);


Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');

});

Route::get('/not_auth', function () {
    return response()->json(['message' => 'not authenticated'], 200);
});


