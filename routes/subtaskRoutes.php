<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubtasksController;



Route::post('subtask', [SubtasksController::class, 'addSubtask']);
Route::put('subtask/{id}', [SubtasksController::class, 'updateSubtask']);
Route::delete('subtask/{id}', [SubtasksController::class, 'deleteSubtask']);
Route::get('/subtask/{id}', [SubtasksController::class, 'getSubtask']);
Route::get('/subtaskes', [SubtasksController::class, 'getSubtasks']);
