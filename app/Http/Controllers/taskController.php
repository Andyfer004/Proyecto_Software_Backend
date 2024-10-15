<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use Illuminate\Support\Facades\Validator;

class taskController extends Controller
{
     // Mostrar lista de tareas
     public function getTask($idprofile)
    {
        // Buscar todas las tareas asociadas al id del perfil
        $tasks = Tasks::where('profileid', $idprofile)->get();

        if ($tasks->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($tasks);
    }



    public function getTasks()
    {
        // Buscar todas las tareas asociadas al id del perfil
        $tasks = Tasks::get();

        if ($tasks->isEmpty()) {
            return response()->json(['error' => 'No tasks found for this profile'], 404);
        }

        return response()->json($tasks);
    }
 
     // Mostrar una tarea específica
     public function show($id)
     {
         $task = Tasks::find($id);
         if ($task) {
             return response()->json($task);
         } else {
             return response()->json(['error' => 'Task not found'], 404);
         }
     }
 
     // Crear una nueva tarea
     public function addTask(Request $request)
     {
         // Define validation rules
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:500',
             'description' => 'required|string',
             'priorityid' => 'nullable|integer',
             'duedate' => 'nullable|date',
             'timeestimatehours' => 'nullable|numeric',
             'profileid' => 'required|integer',
             'statusid' => 'nullable|integer',
         ]);
 
         // Check if validation fails
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 422);
         }
 
         // Create the task
         $task = Tasks::create($validator->validated());
 
         // Return the created task as JSON response
         return response()->json($task, 201);
     }
 
     // Actualizar una tarea existente
     public function updateTask(Request $request, $id)
     {
         $task = Tasks::find($id);
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
         $task = Tasks::find($id);
         if ($task) {
             $task->delete();
             return response()->json(['message' => 'Task deleted successfully']);
         } else {
             return response()->json(['error' => 'Task not found'], 404);
         }
     }
}