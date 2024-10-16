<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;



Route::post('status', [StatusController::class, 'addStatus']);
Route::put('status/{id}', [StatusController::class, 'updateStatus']);
Route::delete('status/{id}', [StatusController::class, 'deleteStatus']);
Route::get('/status/{id}', [StatusController::class, 'getStatus']);
Route::get('/statuses', [StatusController::class, 'getStatuses']);
