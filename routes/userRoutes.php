w<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\loggedMiddleware;

    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::get('/login-google', function () {
        return Socialite::driver('google')->redirect();
    });
     
    Route::get('google-callback', function () {
        $user = Socialite::driver('google')->user();
     
        // $user->token
    });

Route::middleware([loggedMiddleware::class])->group(function () {
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@deactivateAccount');
});