<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'lastname' => 'required|string|max:200',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            // Add additional validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create a new User instance and set its properties from the request
        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash the password
        $user->phone = $request->phone;
        // Set any additional properties

        // Save the user to the database
        $user->save();

        // Optionally, you could dispatch an email or perform other actions here

        // Return a response, possibly including the new user and a token
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
        ], 201);
    }
}

// Don't forget to add the route for this controller method in your routes/web.php or routes/api.php
// Example for routes/api.php:
Route::post('/register', [UserController::class, 'register']);

