<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller{
   
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

    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); 
    }
}
