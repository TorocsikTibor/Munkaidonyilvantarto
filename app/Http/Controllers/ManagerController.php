<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Services\TimerService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function showStatistics()
    {

        $project = Project::count();
        $nOwnProject = Project::where('pmanager_id', Auth::id())->get()->count();
        $ownProjects = Project::where('pmanager_id', Auth::id())->get();
        $timeDiff = new TimerService();

        return view('Manager.manager', compact('project', 'nOwnProject', 'timeDiff'), ['ownProjects' => $ownProjects]);
    }
}
