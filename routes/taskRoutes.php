<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskController;



//Rutas del controlador taskController

Route::post('tasks', [taskController::class, 'addTask']);
Route::put('tasks/{id}', [taskController::class, 'updateTask']);
Route::delete('tasks/{id}', [taskController::class, 'deleteTask']);
Route::get('tasks/{idprofile}', [taskController::class, 'getTask']);
Route::get('tasks', [taskController::class, 'getTasks']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
