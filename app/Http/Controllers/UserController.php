<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profiles;
use App\Models\Profiles_has_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'lastname' => 'required|string|max:200',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
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
            $user->save();
    
            // Crear el perfil asociado al usuario
            $profile = new Profiles();
            $profile->name = $user->name; // Puedes personalizar el nombre del perfil
            $profile->image = 'default.png'; // O establece un valor por defecto para la imagen
            $profile->save();


            $profileHasUser = new Profiles_has_user();
            $profileHasUser->userid = $user->id; // Asignar el id del usuario
            $profileHasUser->profileid = $profile->id; // Asignar el id del perfil
            $profileHasUser->save();
    
            // Retornar la respuesta exitosa
            return response()->json(['user' => $user, 'profile' => $profile, 'message' => 'Usuario y perfil creados con éxito'], 201);
    
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'No se ha podido crear el usuario y el perfil'], 409);
        }
    }
    

    public function login(Request $request){

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Las credenciales son incorrectas'], 401);
        }

        $token = $user->createToken('NombreDelToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            "message" => "Se ha logueado exitosamente",
            'token_type' => 'Bearer'
        ], 200);
        
    }


    public function logout(Request $request){
        // Revoca el token actual
        $request->user()->currentAccessToken()->delete();

        // O revoca todos los tokens del usuario
        $request->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    


    public function index(\App\Models\User $user)
    {
        return $user->paginate(2);
    }
   
      
    public function __construct(\App\Models\User $user){
        $this->user = $user;
    }

    public function deactivateAccount($id){

        $data = $this->user->where('id',$id)->update(['voided'=>'1']);

        if($data>0){
            return ['message'=> 'se ha desactivado correctamente', 'deleted'=> $data];
        }else{
            return ['message'=> 'no se ha podido desactivar, intentalo de nuevo'];
        }

    }

    public function update(Request $request, $id){

        $password = $request->input("password");


        if($password){
            $password = app('hash')->make($password);
            $dataUpdate = $this->user->where('id', $id)->update([
                'name'=>$request->input('name'),
                'lastname'=>$request->input('lastname'),
                'password'=>$password,
                'email'=>$request->input('email'),
                'phone'=>$request->input('phone'),
            ]);
        }else{
            $dataUpdate = $this->user->where('iduser', $id)->update([
                'name'=>$request->input('name'),
                'lastname'=>$request->input('lastname'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
            ]);
        }

        if($dataUpdate>0){
            return ['message'=>'se ha actualizado el usuario correctamente', 'data'=>$dataUpdate];
        }else{
            return ['message'=>'no se ha podido actualizar al usuario'];
        }
        
    }
   
}



