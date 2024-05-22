<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class eventController extends Controller
{
    // Mostrar lista de eventos
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Mostrar un evento específico
    public function show($id)
    {
        $event = Event::find($id);
        if ($event) {
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    // Crear un nuevo evento
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    // Actualizar un evento existente
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->update($request->all());
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    // Eliminar un evento
    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return response()->json(['message' => 'Event deleted successfully']);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
