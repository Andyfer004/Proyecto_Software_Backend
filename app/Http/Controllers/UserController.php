<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'lastname' => 'required|string|max:200',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
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
        $email = $request->input("email");
        $password = $request->input("password");
        
       
        
        $credentials = array(
            'email' => $email,
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->id
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'lastname' => '', // Actualiza según necesites
                    'email' => $googleUser->email,
                    'password' => Hash::make('password'), // Considera un mejor manejo de contraseñas
                    'google_id' => $googleUser->id,
                    // Agrega otros campos necesarios
                ]);
            }

            Auth::login($user);

            return redirect()->to('/home'); // Redirección a donde querramos (pendiente)
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Error al autenticar con Google.'); //Redirección pendiente
        }
    }
   
}



