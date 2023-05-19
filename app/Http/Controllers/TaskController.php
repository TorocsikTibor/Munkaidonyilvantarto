<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateTaskPost;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function edit(Task $task): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Task.edit', ['task' => $task]);
    }

    public function delete(Task $task)
    {
        $task->delete();
        return redirect('project');
    }

    public function update(Task $task, ValidateTaskPost $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $request->validated();

        $task->fill($request->all());
        $task->save();

        return redirect('project')->with('message', 'Változtatás megtörtént!');
    }
}
