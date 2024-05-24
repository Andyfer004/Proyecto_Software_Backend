<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Añadir una nueva tarea
    public function addTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'status' => 'required|string|max:50',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Tarea creada correctamente', 'task' => $task], 201);
    }

    // Actualizar una tarea existente
    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'status' => 'required|string|max:50',
        ]);

        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada'], 404);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Tarea actualizada correctamente', 'task' => $task], 200);
    }

    // Eliminar una tarea
    public function deleteTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Tarea eliminada correctamente'], 200);
    }

    // Mostrar una tarea específica
    public function getTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada'], 404);
        }

        return response()->json(['task' => $task], 200);
    }

    // Mostrar lista de tareas
    public function getTasks()
    {
        $tasks = Task::all();

        return response()->json(['tasks' => $tasks], 200);
    }
}
