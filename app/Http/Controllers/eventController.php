<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Añadir un nuevo evento
    public function addEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event = new Events();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->location = $request->location;
        $event->save();

        return response()->json(['message' => 'Evento creado correctamente', 'event' => $event], 201);
    }

    // Actualizar un evento existente
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'dateevent' => 'required|date',
        ]);

        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->dateevent;
        $event->save();

        return response()->json(['message' => 'Evento actualizado correctamente', 'event' => $event], 200);
    }

    // Eliminar un evento
    public function deleteEvent($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Evento eliminado correctamente'], 200);
    }

    // Mostrar un evento específico
    public function getEvent($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        return response()->json(['event' => $event], 200);
    }

    // Mostrar lista de eventos
    public function getEvents()
    {
        $events = Events::all();

        return response()->json($events, 200);
    }
}
