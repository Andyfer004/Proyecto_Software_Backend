<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RemindersController;



Route::prefix('reminders')->group(function () {
    Route::post('/', [RemindersController::class, 'addReminder']);
    Route::put('/{id}', [RemindersController::class, 'updateReminder']);
    Route::delete('/{id}', [RemindersController::class, 'deleteReminder']);
    Route::get('/{id}', [RemindersController::class, 'getReminder']);
    Route::get('/', [RemindersController::class, 'getReminders']);
});
