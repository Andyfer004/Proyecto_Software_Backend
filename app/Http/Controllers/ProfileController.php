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

        return response()->json(['profile' => $profile], 200);
    }

   
    public function getProfiles()
    {
        $profiles = Profiles::all();

        return response()->json(['profiles' => $profiles], 200);
    }
}