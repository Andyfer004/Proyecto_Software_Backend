<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('status', [StatusController::class, 'addStatus']);
Route::put('status/{id}', [StatusController::class, 'updateStatus']);
Route::delete('status/{id}', [StatusController::class, 'deleteStatus']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas del controlador taskController

Route::post('tasks', [TaskController::class, 'addTask']);
Route::put('tasks/{id}', [TaskController::class, 'updateTask']);
Route::delete('tasks/{id}', [TaskController::class, 'deleteTask']);
Route::get('tasks/{id}', [TaskController::class, 'getTask']);
Route::get('tasks', [TaskController::class, 'getTasks']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
