<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subtask;

class SubtasksController extends Controller
{
    public function addSubtask(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priorityid' => 'required|integer',
            'duedate' => 'required|date',
            'timeestimatehours' => 'nullable|integer',
            'taskid' => 'required|integer',
            'statusid' => 'required|integer',
        ]);

        $subtask = new Subtask();
        $subtask->name = $request->name;
        $subtask->description = $request->description;
        $subtask->priorityid = $request->priorityid;
        $subtask->duedate = $request->duedate;
        $subtask->timeestimatehours = $request->timeestimatehours;
        $subtask->taskid = $request->taskid;
        $subtask->statusid = $request->statusid;
        $subtask->save();

        return response()->json(['message' => 'Subtarea creada correctamente', 'subtask' => $subtask], 201);
    }

    public function updateSubtask(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priorityid' => 'required|integer',
            'duedate' => 'required|date',
            'timeestimatehours' => 'nullable|integer',
            'taskid' => 'required|integer',
            'statusid' => 'required|integer',
        ]);

        $subtask = Subtask::find($id);
        if (!$subtask) {
            return response()->json(['message' => 'Subtarea no encontrada'], 404);
        }

        $subtask->name = $request->name;
        $subtask->description = $request->description;
        $subtask->priorityid = $request->priorityid;
        $subtask->duedate = $request->duedate;
        $subtask->timeestimatehours = $request->timeestimatehours;
        $subtask->taskid = $request->taskid;
        $subtask->statusid = $request->statusid;
        $subtask->save();

        return response()->json(['message' => 'Subtarea actualizada correctamente', 'subtask' => $subtask], 200);
    }

    public function deleteSubtask($id)
    {
        $subtask = Subtask::find($id);
        if (!$subtask) {
            return response()->json(['message' => 'Subtarea no encontrada'], 404);
        }

        $subtask->delete();

        return response()->json(['message' => 'Subtarea eliminada correctamente'], 200);
    }

    public function getSubtask($id)
    {
        $subtask = Subtask::find($id);
        if (!$subtask) {
            return response()->json(['message' => 'Subtarea no encontrada'], 404);
        }

        return response()->json(['subtask' => $subtask], 200);
    }

    public function getSubtasks()
    {
        $subtasks = Subtask::all();

        return response()->json(['subtasks' => $subtasks], 200);
    }
}
