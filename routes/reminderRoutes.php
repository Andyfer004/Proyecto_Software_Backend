<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RemindersController;




    Route::post('reminders/', [RemindersController::class, 'addReminder']);
    Route::put('reminders/{id}', [RemindersController::class, 'updateReminder']);
    Route::delete('reminders/{id}', [RemindersController::class, 'deleteReminder']);
    Route::get('reminders/{id}', [RemindersController::class, 'getReminder']);
    Route::get('reminders/', [RemindersController::class, 'getReminders']);

