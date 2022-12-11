<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function makeProject()
    {
        return view('project.createproject');
    }

    public function listProject()
    {
        return view('project.showproject');
    }
}
