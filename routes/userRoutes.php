<?php

use Illuminate\Support\Facades\Route;


    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');


Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');

});

Route::get('/not_auth', function () {
    return response()->json(['message' => 'not authenticated'], 200);
});