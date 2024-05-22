<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
