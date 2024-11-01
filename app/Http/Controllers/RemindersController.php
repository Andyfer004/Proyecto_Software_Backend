<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminders;

class RemindersController extends Controller
{
    public function addReminder(Request $request)
    {
        // Validación de los datos entrantes
        $request->validate([
            'description' => 'required|string',
            'alarm' => 'required|boolean',
            'profileid' => 'required|integer|exists:profiles,id',
            'priorityid' => 'required|integer|exists:priorities,id',
            'completed' => 'nullable|boolean', // Agregar validación para el campo completed
        ]);

        // Crear un nuevo recordatorio
        $reminder = new Reminders();
        $reminder->description = $request->description;
        $reminder->alarm = $request->alarm;
        $reminder->datereminder = $request->datereminder;
        $reminder->hourreminder = $request->hourreminder;
        $reminder->profileid = $request->profileid;
        $reminder->priorityid = $request->priorityid;
        $reminder->completed = $request->completed; // Asignar el campo completed
        $reminder->save();

        return response()->json(['message' => 'Recordatorio creado correctamente', 'reminder' => $reminder], 201);
    }

    public function updateReminder(Request $request, $id)
    {
        // Validación de los datos entrantes
        $request->validate([
            'description' => 'sometimes|string',
            'alarm' => 'sometimes|boolean',
            'profileid' => 'sometimes|integer|exists:profiles,id',
            'priorityid' => 'sometimes|integer|exists:priorities,id',
            'completed' => 'sometimes|boolean', // Agregar validación para el campo completed
        ]);

        // Buscar el recordatorio por ID
        $reminder = Reminders::find($id);
        if (!$reminder) {
            return response()->json(['message' => 'Recordatorio no encontrado'], 404);
        }

        // Actualizar los datos del recordatorio
        if ($request->has('description')) {
            $reminder->description = $request->description;
        }
        if ($request->has('alarm')) {
            $reminder->alarm = $request->alarm;
        }
        if ($request->has('datereminder')) {
            $reminder->datereminder = $request->datereminder;
        }
        if ($request->has('hourreminder')) {
            $reminder->hourreminder = $request->hourreminder;
        }
        if ($request->has('profileid')) {
            $reminder->profileid = $request->profileid;
        }
        if ($request->has('priorityid')) {
            $reminder->priorityid = $request->priorityid;
        }
        if ($request->has('completed')) {
            $reminder->completed = $request->completed; // Asignar el campo completed
        }

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

    public function getReminders()
    {
        // Obtener todos los recordatorios
        $reminders = Reminders::all();

        return response()->json(['reminders' => $reminders], 200);
    }
}
