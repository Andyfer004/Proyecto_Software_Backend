<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;



Route::post('reminder', [ReminderController::class, 'addReminder']);
Route::put('reminder/{id}', [ReminderController::class, 'updateReminder']);
Route::delete('reminder/{id}', [ReminderController::class, 'deleteReminder']);
Route::get('/reminder/{id}', [ReminderController::class, 'getReminder']);
Route::get('/reminders', [ReminderController::class, 'getReminders']);
