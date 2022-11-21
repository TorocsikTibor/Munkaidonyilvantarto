<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveCalculate;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AdminController
{


//    public function updateProject(Project $project, Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
//    {                                                           //todo validate
//        $request->validate([
//            'name' => 'required',
//            'pmanager_id' => 'required|integer',
//            'description' => 'required|max:1000',
//            'deadline' => 'required|date|after:yesterday',
//        ]);
//
//        $project->fill($request->all());
//        $project->save();
//
//        if(Auth::user()->can('admin'))
//        {
//            return redirect('admin/projects');
//        } else {
//            return redirect('manager');
//        }
//    }

    public function deleteProject(Project $project)
    {
        $project->delete();
        if(Auth::user()->can('admin'))
        {
            return redirect('admin/projects');
        } else {
            return redirect('manager');
        }
    }

    public function editProject(Project $project)
    {
        return view('admin.editproject', ['project' => $project]);
    }

    public function showProjects()
    {
        $projects = Project::all();
        return view('admin.showprojects', ['projects' => $projects]);
    }

    public function updateUser(User $user, Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'leave_number' => 'required|integer',
            'sick_leave' => 'required|integer',
            'starting_work' => 'required|date',
            'birthday' => 'required|date',
            'children' => 'required|integer',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->leave_number = $request->input('leave_number');
        $user->sick_leave = $request->input('sick_leave');
        $user->save();

        $userLeave = LeaveCalculate::find($user->id);
        $userLeave->starting_work = $request->input('starting_work');
        $userLeave->children = $request->input('children');
        $userLeave->birthday = $request->input('birthday');
        $userLeave->save();

        return redirect('admin/users');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect('admin/users');
    }

    public function editUser(User $user)
    {
        return view('admin.edituser', ['user' => $user]);
    }

    public function showUsers()
    {
        $users = User::all();
        return view('admin.showusers', ['users' => $users]);
    }

    public function deleteLeave(Leave $leave)
    {
        $leave->delete();
        return redirect('admin/leaves');
    }

    public function updateLeave(Leave $leave, Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {                                                           //todo validate
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'desc' => 'required',
            'type' => 'required|integer',
            'status' => 'required',
        ]);
        $leave->fill($request->all());
        $leave->save();

        return redirect('admin/leaves');
    }

    public function editLeave(Leave $leave)
    {
        return view('admin.editleave', ['leave' => $leave]);
    }

    public function showLeaves()
    {
        $leaves = Leave::all();
        return view('admin.showleaves', ['leaves' => $leaves]);
    }

    public function showStatistics()
    {
        $projects = Project::count();
        $users = User::count();
        $leaves = Leave::count();
        return view('admin.show', compact('projects','users', 'leaves'));
    }
}
