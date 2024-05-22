<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    //rutas del controlador ProfileController
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');


Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');

});

Route::get('/not_auth', function () {
    return response()->json(['message' => 'not authenticated'], 200);
});