<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Request $request) {
        Task::create($request->all());

        return 'sucesso';
    }
}
