<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminders;

class RemindersController extends Controller
{
    public function addReminder(Request $request)
    {
        $request->validate([
            'alarm' => 'required|boolean',
            'profileid' => 'required|integer',
        ]);

        $reminder = new Reminders();
        $reminder->description = $request->description;
        $reminder->alarm = $request->alarm;
        $reminder->datereminder = $request->datereminder;
        $reminder->hourreminder = $request->hourreminder;
        $reminder->profileid = $request->profileid;
        $reminder->save();

        return response()->json(['message' => 'Recordatorio creado correctamente', 'reminder' => $reminder], 201);
    }

    public function updateReminder(Request $request, $id)
    {
        $request->validate([
            'alarm' => 'required|boolean',
            'profileid' => 'required|integer',
        ]);

        $reminder = Reminders::find($id);
        if (!$reminder) {
            return response()->json(['message' => 'Recordatorio no encontrado'], 404);
        }

        $reminder->description = $request->description;
        $reminder->alarm = $request->alarm;
        $reminder->datereminder = $request->datereminder;
        $reminder->hourreminder = $request->hourreminder;
        $reminder->profileid = $request->profileid;
        $reminder->save();

        return response()->json(['message' => 'Recordatorio actualizado correctamente', 'reminder' => $reminder], 200);
    }

    public function deleteReminder($id)
    {
        $reminder = Reminders::find($id);
        if (!$reminder) {
            return response()->json(['message' => 'Recordatorio no encontrado'], 404);
        }

        $reminder->delete();

        return response()->json(['message' => 'Recordatorio eliminado correctamente'], 200);
    }

    public function getReminder($id)
    {
        $reminder = Reminders::find($id);
        if (!$reminder) {
            return response()->json(['message' => 'Recordatorio no encontrado'], 404);
        }

        return response()->json(['reminder' => $reminder], 200);
    }

    public function getReminders()
    {
        $reminders = Reminders::all();

        return response()->json(['reminders' => $reminders], 200);
    }
}
