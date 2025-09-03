<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task; 
    }

    public function index() {
        $tasks = Task::all();

        return $tasks;
    }

    public function get($id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Tarefa não encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }

    public function store(Request $request) {
        Task::create($request->all());

        return response()->json(['message' => 'Tarefa criada com sucesso!']);
    }

    public function update(Request $request, $id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Tarefa não encontrada'
            ], 404);
        }

        $updated = $task->update($request->all());

        if ($updated) {
            return response()->json(['message' => 'Tarefa atualizada com sucesso!']);
        }
    }

    public function delete($id) {
        $deleted = Task::destroy($id);

        if ($deleted) {
            return response()->json(['message' => 'Tarefa excluída com sucesso!']);
        }
    }
}
