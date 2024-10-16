<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priorities;

class PrioritiesController extends Controller
{
    public function addPriority(Request $request)
    {
        $request->validate([
            'namepriority' => 'required|string|max:50',
        ]);

        $priority = new Priorities();
        $priority->namepriority = $request->namepriority;
        $priority->save();

        return response()->json(['message' => 'Prioridad creada correctamente', 'priority' => $priority], 201);
    }

    public function updatePriority(Request $request, $id)
    {
        $request->validate([
            'namepriority' => 'required|string|max:50',
        ]);

        $priority = Priorities::find($id);
        if (!$priority) {
            return response()->json(['message' => 'Prioridad no encontrada'], 404);
        }

        $priority->namepriority = $request->namepriority;
        $priority->save();

        return response()->json(['message' => 'Prioridad actualizada correctamente', 'priority' => $priority], 200);
    }

    public function deletePriority($id)
    {
        $priority = Priorities::find($id);
        if (!$priority) {
            return response()->json(['message' => 'Prioridad no encontrada'], 404);
        }

        $priority->delete();

        return response()->json(['message' => 'Prioridad eliminada correctamente'], 200);
    }

    public function getPriority($id)
    {
        $priority = Priorities::find($id);
        if (!$priority) {
            return response()->json(['message' => 'Prioridad no encontrada'], 404);
        }

        return response()->json(['priority' => $priority], 200);
    }

    public function getPriorities()
    {
        $priorities = Priorities::all();

        return response()->json(['priorities' => $priorities], 200);
    }


}
