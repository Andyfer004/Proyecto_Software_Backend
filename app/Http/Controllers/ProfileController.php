<?php

namespace App\Http\Controllers;

use App\Models\Profiles; 
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function addProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'image' => 'required|string|max:100',
        ]);

        $profile = new Profiles();
        $profile->name = $request->name;
        $profile->image = $request->image;
        $profile->save();

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

   
    public function getProfiles()
    {
        $profiles = Profiles::all();

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