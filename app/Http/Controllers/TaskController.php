<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function edit(Task $task)
    {
        return view('Task.edit', ['task' => $task]);
    }

    public function update(Task $task, Request $request)
    {                                                           //todo validate
        $task->fill($request->all());
        $task->save();

        return redirect('project');
    }
}
