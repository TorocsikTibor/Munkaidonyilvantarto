<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;

class MakeProject extends Component
{

    public $searchTerm;
    public $Susers;
    public $selectedUsers = [];
    public $aUsers;
//    public $projects;
    public $name;
    public $pmanager_id;

    public function saveProject()
    {
        $project = new Project;
        $project->name = $this->name;
        $project->pmanager_id = $this->pmanager_id;
        $project->save();

        foreach ($this->selectedUsers as $this->user) {
        $selectedUser = new ProjectUser();
        $selectedUser->project_id = $project->id;
        $selectedUser->user_id = $this->user;
        $selectedUser->save();
        }
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->Susers = User::where('name', 'like', $searchTerm)->get();
        $this->aUsers = User::all();
//        $this->projects =  Project::with('user')->get();

        return view('livewire.make-project', [
            'projects' => Project::with('pManager')->get(),
            'users' => User::when(count(array_filter($this->selectedUsers)), function ($query) {
                return $query->whereIn('name', $this->selectedUsers);
            })
        ]);

    }
}
