<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\loggedMiddleware;

    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');


Route::middleware([loggedMiddleware::class])->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');
});