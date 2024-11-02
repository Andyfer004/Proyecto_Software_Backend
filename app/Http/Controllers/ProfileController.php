<?php

namespace App\Http\Controllers;

use App\Models\Profiles; 
use App\Models\Profiles_has_user; 
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function addProfile(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:200',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que es una imagen
        ]);

        // Procesar y guardar la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/profiles'), $imageName); // Guardar en /public/images/profiles
            $imagePath = 'images/profiles/' . $imageName; // Ruta relativa para guardar en la DB
    }

        // Crear el perfil
        $profile = new Profiles();
        $profile->name = $request->name;
        $profile->image = $imagePath;
        $profile->save();


        $profile_has_user = new Profiles_has_user();

        $profile_has_user->userid = $request->user()->id;

        $profile_has_user->profileid = $profile->id;

        $profile_has_user->save();

        return response()->json(['message' => 'Perfil creado correctamente', 'profile' => $profile], 201);
    }

    
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'image' => 'required|string|max:100',
        ]);

        $profile = Profiles::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        $profile->name = $request->name;
        $profile->image = $request->image;
        $profile->save();


        return response()->json(['message' => 'Perfil actualizado correctamente', 'profile' => $profile], 200);
    }

    
    public function deleteProfile($id)
    {
        $profile = Profiles::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        $profile->delete();

        return response()->json(['message' => 'Perfil eliminado correctamente'], 200);
    }

    
    public function getProfile($id)
    {
        $profile = Profiles::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        return response()->json($profile, 200);
    }

   
    public function getProfiles(Request $request)
    {
        $userId = $request->user()->id; 
    
        $profiles = Profiles_has_user::where('userid', $userId)
        ->join('profiles', 'profiles.id', '=', 'profiles_has_user.profileid')
        ->select('profiles.*') // Selecciona las columnas de la tabla `profiles`
        ->get();
    
        return response()->json($profiles, 200);
    }



    public function assignProfileToUser(Request $request)
    {
        $request->validate([
            'profileId' => 'required|exists:profiles,id', // Validar que el perfil exista
            'userId' => 'required|exists:users,id', // Validar que el usuario exista
        ]);

        $profile = Profiles::find($request->profileId);
        $user = User::find($request->userId);

        // Asumimos que tienes una relación en tu modelo User para asociar perfiles
        $user->profiles()->attach($profile); // Asignar el perfil al usuario

        return response()->json([
            'message' => 'Perfil asignado al usuario correctamente',
            'profile' => $profile,
            'user' => $user
        ], 200);
    }
}