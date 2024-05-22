<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class taskController extends Controller
{
     // Mostrar lista de tareas
     public function index()
     {
         $tasks = Task::all();
         return response()->json($tasks);
     }
 
     // Mostrar una tarea específica
     public function show($id)
     {
         $task = Task::find($id);
         if ($task) {
             return response()->json($task);
         } else {
             return response()->json(['error' => 'Task not found'], 404);
         }
     }
 
     // Crear una nueva tarea
     public function store(Request $request)
     {
         $task = Task::create($request->all());
         return response()->json($task, 201);
     }
 
     // Actualizar una tarea existente
     public function update(Request $request, $id)
     {
         $task = Task::find($id);
         if ($task) {
             $task->update($request->all());
             return response()->json($task);
         } else {
             return response()->json(['error' => 'Task not found'], 404);
         }
     }
 
     // Eliminar una tarea
     public function destroy($id)
     {
         $task = Task::find($id);
         if ($task) {
             $task->delete();
             return response()->json(['message' => 'Task deleted successfully']);
         } else {
             return response()->json(['error' => 'Task not found'], 404);
         }
     }
}
