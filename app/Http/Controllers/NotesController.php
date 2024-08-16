<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;


class NotesController extends Controller
{
    public function addNote(Request $request)
    {
        $request->validate([
            'note' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'profileid' => 'required|integer',
        ]);

        $note = new Notes();
        $note->note = $request->note;
        $note->image = $request->image;
        $note->profileid = $request->profileid;
        $note->save();

        return response()->json(['message' => 'Nota creada correctamente', 'note' => $note], 201);
    }

    public function updateNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'profileid' => 'required|integer',
        ]);

        $note = Notes::find($id);
        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $note->note = $request->note;
        $note->image = $request->image;
        $note->profileid = $request->profileid;
        $note->save();

        return response()->json(['message' => 'Nota actualizada correctamente', 'note' => $note], 200);
    }

    public function deleteNote($id)
    {
        $note = Notes::find($id);
        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Nota eliminada correctamente'], 200);
    }

    public function getNote($id)
    {
        $note = Notes::find($id);
        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        return response()->json(['note' => $note], 200);
    }

    public function getNotes()
    {
        $notes = Notes::all();

        return response()->json(['notes' => $notes], 200);
    }


}
