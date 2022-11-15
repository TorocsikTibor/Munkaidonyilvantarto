<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function showStatistics()
    {
        $project = Project::count();
        $nOwnProject = Project::where('pmanager_id', Auth::id())->get()->count();
        $ownProjects = Project::where('pmanager_id', Auth::id())->get();
        return view('Manager.manager', compact('project', 'nOwnProject'), ['ownProjects' => $ownProjects]);
    }
}
