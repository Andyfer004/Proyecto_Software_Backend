<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\EventController;

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


//Rutas de eventos
Route::post('events', [EventController::class, 'addEvent']);
Route::put('events/{id}', [EventController::class, 'updateEvent']);
Route::delete('events/{id}', [EventController::class, 'deleteEvent']);
Route::get('events/{id}', [EventController::class, 'getEvent']);
Route::get('events', [EventController::class, 'getEvents']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
