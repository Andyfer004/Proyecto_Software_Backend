<?php

namespace App\Http\Controllers;

use App\Models\Priorities;
use Illuminate\Http\Request;

class PrioritiesController extends Controller
{
    
    public function index()
    {
        $priorities = Priorities::all();
        return response()->json($priorities);
    }

    public function store(Request $request)
    {
        $request->validate([
            'namepriority' => 'required|string|max:255',
        ]);

        $priority = Priorities::create($request->all());
        return response()->json($priority, 201);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'namepriority' => 'required|string|max:255',
        ]);

        $priority = Priorities::findOrFail($id);
        $priority->update($request->all());
        return response()->json($priority);
    }

    
    public function destroy($id)
    {
        $priority = Priorities::findOrFail($id);
        $priority->delete();
        return response()->json(null, 204);
    }
}
