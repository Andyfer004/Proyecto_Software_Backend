<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Status;

class StatusController extends Controller
{
    public function addStatus(Request $request)
    {
        $request->validate([
            'statusname' => 'required|string|max:50',
        ]);

        $status = new Status();
        $status->statusname = $request->statusname;
        $status->save();

        return response()->json(['message' => 'Estado creado correctamente', 'status' => $status], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statusname' => 'required|string|max:50',
        ]);

        $status = Status::find($id);
        if (!$status) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        $status->statusname = $request->statusname;
        $status->save();

        return response()->json(['message' => 'Estado actualizado correctamente', 'status' => $status], 200);
    }

    public function deleteStatus($id)
    {
        $status = Status::find($id);
        if (!$status) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        $status->delete();

        return response()->json(['message' => 'Estado eliminado correctamente'], 200);
    }

    public function getStatus($id)
    {
        $status = Status::find($id);
        if (!$status) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        return response()->json(['status' => $status], 200);
    }

    public function getStatuses()
    {
        $statuses = Status::all();

        return response()->json(['statuses' => $statuses], 200);
    }
    
}
