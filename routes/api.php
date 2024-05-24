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



 //rutas del controlador ProfileController
 Route::post('/profiles', [ProfileController::class, 'addProfile']);
 Route::put('/profiles/{id}', [ProfileController::class, 'updateProfile']);
 Route::delete('/profiles/{id}', [ProfileController::class, 'deleteProfile']);
 Route::get('/profiles/{id}', [ProfileController::class, 'getProfile']);
 Route::get('/profiles', [ProfileController::class, 'getProfiles']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
