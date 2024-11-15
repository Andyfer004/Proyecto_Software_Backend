<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminders;

class RemindersController extends Controller
{
    public function addReminder(Request $request)
{
    $request->validate([
        'description' => 'required|string',
        'alarm' => 'required|boolean',
        'datereminder' => 'required|date',
        'hourreminder' => 'required|string',
        'profileid' => 'required|integer|exists:profiles,id',
        'priorityid' => 'required|integer|exists:priorities,id',
    ]);

    // Crear un nuevo recordatorio
    $reminder = new Reminders();
    $reminder->description = $request->description;
    $reminder->alarm = $request->alarm;
    $reminder->datereminder = $request->datereminder;
    $reminder->hourreminder = $request->hourreminder;
    $reminder->profileid = $request->profileid;
    $reminder->priorityid = $request->priorityid;
    $reminder->save();

    return response()->json(['message' => 'Recordatorio creado correctamente', 'reminder' => $reminder], 201);
}

    


public function updateReminder(Request $request, $id)
{
    $request->validate([
        'description' => 'sometimes|string',
        'alarm' => 'sometimes|boolean',
        'datereminder' => 'sometimes|date',
        'hourreminder' => 'sometimes|string',
        'profileid' => 'sometimes|integer|exists:profiles,id',
        'priorityid' => 'sometimes|integer|exists:priorities,id',
    ]);

    $reminder = Reminders::find($id);
    if (!$reminder) {
        return response()->json(['message' => 'Recordatorio no encontrado'], 404);
    }

    $reminder->description = $request->description ?? $reminder->description;
    $reminder->alarm = $request->alarm ?? $reminder->alarm;
    $reminder->datereminder = $request->datereminder ?? $reminder->datereminder;
    $reminder->hourreminder = $request->hourreminder ?? $reminder->hourreminder;
    $reminder->profileid = $request->profileid ?? $reminder->profileid;
    $reminder->priorityid = $request->priorityid ?? $reminder->priorityid;
    $reminder->completed = $request->completed ?? $reminder->completed;

    $reminder->save();

    return response()->json(['message' => 'Recordatorio actualizado correctamente', 'reminder' => $reminder], 200);
}


    public function deleteReminder($id)
    {
        // Buscar el recordatorio por ID
        $reminder = Reminders::find($id);
        if (!$reminder) {
            return response()->json(['message' => 'Recordatorio no encontrado'], 404);
        }

        // Eliminar el recordatorio
        $reminder->delete();

        return response()->json(['message' => 'Recordatorio eliminado correctamente'], 200);
    }

    public function getReminder($id)
    {
        // Buscar el recordatorio por ID
        $reminder = Reminders::find($id);
        if (!$reminder) {
            return response()->json(['message' => 'Recordatorio no encontrado'], 404);
        }

        return response()->json(['reminder' => $reminder], 200);
    }

    public function getReminders(Request $request)
    {
        // Obtener el profileid del request
        $profileId = $request->input('profileid'); 
    
        if (!$profileId) {
            return response()->json(['message' => 'Profile ID no especificado'], 400);
        }
    
        // Verificar que el profileid pertenece al usuario logueado
        $userId = $request->user()->id;
        $profileBelongsToUser = \App\Models\Profiles_has_user::where('userid', $userId)
                                  ->where('profileid', $profileId)
                                  ->exists();
    
        if (!$profileBelongsToUser) {
            return response()->json(['message' => 'No tienes permiso para acceder a estos recordatorios'], 403);
        }
    
        // Obtener reminders asociados al profileid
        $reminders = Reminders::where('profileid', $profileId)->get();
    
        return response()->json(['reminders' => $reminders], 200);
    }
    

}
