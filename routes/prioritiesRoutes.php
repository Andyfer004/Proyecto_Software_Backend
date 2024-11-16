<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\prioritiesController;


Route::post('priorities', [PrioritiesController::class, 'addPriority']);
Route::put('priorities/{id}', [PrioritiesController::class, 'updatePriority']);
Route::delete('priorities/{id}', [PrioritiesController::class, 'deletePriority']);
Route::get('priorities/{id}', [PrioritiesController::class, 'getPriority']);
Route::get('priorities', [PrioritiesController::class, 'getPriorities']);
Route::get('/priorities/user/{id}', [PrioritiesController::class, 'getPrioritiesByUserId']);
