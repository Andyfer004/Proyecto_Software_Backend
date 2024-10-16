<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\eventController;



//Rutas de eventos
Route::post('events', [EventController::class, 'addEvent']);
Route::put('events/{id}', [EventController::class, 'updateEvent']);
Route::delete('events/{id}', [EventController::class, 'deleteEvent']);
Route::get('events/{id}', [EventController::class, 'getEvent']);
Route::get('events', [EventController::class, 'getEvents']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

