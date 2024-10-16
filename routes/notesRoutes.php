<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;



Route::post('notes', [NotesController::class, 'addNote']);
Route::put('notes/{id}', [NotesController::class, 'updateNote']);
Route::delete('notes/{id}', [NotesController::class, 'deleteNote']);
Route::get('notes/{id}', [NotesController::class, 'getNote']);
Route::get('notes', [NotesController::class, 'getNotes']);

