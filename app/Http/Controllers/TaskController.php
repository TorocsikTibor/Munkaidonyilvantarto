<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function edit(Task $task): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Task.edit', ['task' => $task]);
    }

    public function update(Task $task, Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {                                                           //todo validate
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:1000',
        ]);

        $task->fill($request->all());
        $task->save();

        return redirect('project');
    }
}
