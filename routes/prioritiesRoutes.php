<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\prioritiesController;


Route::post('priorities', [prioritiesController::class, 'addPriority']);
Route::put('priorities/{id}', [prioritiesController::class, 'updatePriority']);
Route::delete('priorities/{id}', [prioritiesController::class, 'deletePriority']);
Route::get('priorities/{id}', [prioritiesController::class, 'getPriority']);
Route::get('priorities', [prioritiesController::class, 'getPriorities']);
