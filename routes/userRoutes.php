<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);


Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');

});

Route::get('/not_auth', function () {
    return response()->json(['message' => 'not authenticated'], 200);
});


