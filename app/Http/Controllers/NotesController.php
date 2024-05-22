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
            'profile_id' => 'required|integer',
        ]);

        $note = new Notes();
        $note->note = $request->note;
        $note->image = $request->image;
        $note->profile_id = $request->profile_id;
        $note->save();

        return response()->json(['message' => 'Nota creada correctamente', 'note' => $note], 201);
    }

}
