<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PrioritiesController;
use App\Http\Controllers\NotesController;


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
Route::get('/status/{id}', [StatusController::class, 'getStatus']);
Route::get('/statuses', [StatusController::class, 'getStatuses']);


/* route priorities */
Route::post('priorities', [PrioritiesController::class, 'addPriority']);
Route::put('priorities/{id}', [PrioritiesController::class, 'updatePriority']);
Route::delete('priorities/{id}', [PrioritiesController::class, 'deletePriority']);
Route::get('priorities/{id}', [PrioritiesController::class, 'getPriority']);
Route::get('priorities', [PrioritiesController::class, 'getPriorities']);

Route::post('notes', [NotesController::class, 'addNote']);
Route::put('notes/{id}', [NotesController::class, 'updateNote']);
Route::delete('notes/{id}', [NotesController::class, 'deleteNote']);
Route::get('notes/{id}', [NotesController::class, 'getNote']);
Route::get('notes', [NotesController::class, 'getNotes']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
