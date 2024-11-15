<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class settingsController extends Controller
{
    public function getSettingByKey(Request $request, $key)
    {
        // Obtener la configuración que coincida con la clave y el usuario autenticado
        $setting = Setting::where('key', $key)
            ->where('userid', $request->user()->id) // Asegurarse de que pertenece al usuario autenticado
            ->first();

        if (!$setting) {
            return response()->json([
                'message' => 'Setting not found',
            ], 404);
        }

        return response()->json($setting);
    }



    public function saveSetting(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'nullable|string',
        ]);

        // Guardar o actualizar la configuración
        $setting = Setting::updateOrCreate(
            [
                'key' => $request->key,
                'userid' => $request->user()->id,
            ],
            [
                'value' => $request->value,
            ]
        );

        return response()->json([
            'message' => 'Setting saved successfully',
            'setting' => $setting,
        ], 200);
    }

}
