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

}
