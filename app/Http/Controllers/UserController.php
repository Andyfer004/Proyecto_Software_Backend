<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'lastname' => 'required|string|max:200',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            // Include other fields as necessary
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->phone = $request->input('phone');
            // You can add more fields here if you have more columns in your users table

            $user->save();

            // Return successful response
            return response()->json(['user' => $user, 'message' => 'Usuario creado con éxito'], 201);

        } catch (\Exception $e) {
            // It's a good idea to log the actual error message in your logs
            \Log::error($e->getMessage());
            return response()->json(['message' => 'No se ha podido crear el usuario'], 409);
        }
    }

  
    public function login(Request $request){
        $userName = $request->input("userName");
        $password = $request->input("password");
        
       
        
        $credentials = array(
            'userName' => $userName,
            'password' =>  $password
        );
        
       

        if (! $token = Auth::attempt($credentials)) {
            
            return response()->json(['message' => 'usuario o contraseña incorrecta'], 401);
        }
        return  $this->respondWithToken($token);
    }

    


    public function index(\App\Models\User $user)
    {
        return $user->paginate(2);
    }
   
      
    public function __construct(\App\Models\User $user){
        $this->user = $user;
    }
   
}



