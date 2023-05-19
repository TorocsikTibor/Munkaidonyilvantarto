<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateLeavePost;
use App\Http\Requests\ValidateUserPost;
use App\Models\Leave;
use App\Models\LeaveCalculate;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AdminController
{

    public function deleteProject(Project $project): Redirector|Application|RedirectResponse
    {
        $project->delete();
        if(Auth::user()->can('admin'))
        {
            return redirect('admin/projects');
        } else {
            return redirect('manager');
        }
    }

    public function editProject(Project $project): Factory|View|Application
    {
        return view('admin.editproject', ['project' => $project]);
    }

    public function showProjects(): Factory|View|Application
    {
        $projects = Project::all();
        return view('admin.showprojects', ['projects' => $projects]);
    }

    // todo validator hasznalata
    // todo validated input
    // todo tansactions megnézése
    public function updateUser(ValidateUserPost $request, User $user) : Application|RedirectResponse|Redirector
    {
        $request->validated();

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

    public function deleteUser(User $user): Redirector|Application|RedirectResponse
    {
        $user->delete();
        return redirect('admin/users');
    }

    public function editUser(User $user): Factory|View|Application
    {
        return view('admin.edituser', ['user' => $user]);
    }

    public function showUsers(): Factory|View|Application
    {
        $users = User::all();
        return view('admin.showusers', ['users' => $users]);
    }

    public function deleteLeave(Leave $leave): Redirector|Application|RedirectResponse
    {
        $leave->delete();
        return redirect('admin/leaves');
    }

    public function updateLeave(Leave $leave, ValidateLeavePost $request) : Application|RedirectResponse|Redirector
    {
        $request->validated();
        $leave->fill($request->all());
        $leave->save();

        return redirect('admin/leaves');
    }

    public function editLeave(Leave $leave): Factory|View|Application
    {
        return view('admin.editleave', ['leave' => $leave]);
    }

    public function showLeaves(): Factory|View|Application
    {
        $leaves = Leave::all();
        return view('admin.showleaves', ['leaves' => $leaves]);
    }

    public function showStatistics(): Factory|View|Application
    {
        $projects = Project::count();
        $users = User::count();
        $leaves = Leave::count();
        return view('admin.show', compact('projects','users', 'leaves'));
    }
}
