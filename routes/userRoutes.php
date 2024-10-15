<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubtasksController;


    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');




Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');

});

Route::prefix('subtasks')->group(function () {
    Route::post('/', [SubtasksController::class, 'addSubtask']);
    Route::put('/{id}', [SubtasksController::class, 'updateSubtask']);
    Route::delete('/{id}', [SubtasksController::class, 'deleteSubtask']);
    Route::get('/{id}', [SubtasksController::class, 'getSubtask']);
    Route::get('/', [SubtasksController::class, 'getSubtasks']);
});




Route::get('/not_auth', function () {
    return response()->json(['message' => 'not authenticated'], 200);
});


