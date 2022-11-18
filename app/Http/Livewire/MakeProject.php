<?php

namespace App\Http\Livewire;

use App\Services\TimerService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Models\ProjectUser;

class MakeProject extends Component
{

    public $selectedUsers = [];

    public $searchTerm;
    public $Susers;
    public $name;
    public $description;
    public $deadline;
    public $pmanager_id;

    protected $rules = [
        'name' => 'required',
        'taskName' => 'required',
    ];

    public function saveProject()
    {
        $project = new Project;
        $project->name = $this->name;
        $project->pmanager_id = $this->pmanager_id;
        $project->description = $this->description;
        $project->deadline = $this->deadline;
        $project->save();

        foreach ($this->selectedUsers as $this->user) {
            $selectedUser = new ProjectUser();
            $selectedUser->project_id = $project->id;
            $selectedUser->user_id = $this->user;
            $selectedUser->save();
        }
        return redirect()->to('/project');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->Susers = User::where('name', 'like', $searchTerm)->get();

        return view('livewire.make-project', [

            'aUsers' => User::paginate(10),
            'users' => User::when(count(array_filter($this->selectedUsers)), function ($query) {
                return $query->whereIn('name', $this->selectedUsers);
            })
        ]);
    }

}

