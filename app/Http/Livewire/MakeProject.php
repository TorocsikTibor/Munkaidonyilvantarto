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
    public $taskName;
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
        $project->save();

        foreach ($this->selectedUsers as $this->user) {
            $selectedUser = new ProjectUser();
            $selectedUser->project_id = $project->id;
            $selectedUser->user_id = $this->user;
            $selectedUser->save();
        }
    }

    public function createTimer($project_id)
    {
        $task = new Task;
        $task->project_id = $project_id;
        $task->user_id = Auth::id();
        $task->name = $this->taskName;
        $task->timer_start = Carbon::now();
        $task->save();
    }

    public function endTimer($id)
    {
        $selectTimer = Task::find($id);
        $selectTimer->timer_end = Carbon::now();
        $selectTimer->save();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
    if(Auth::user()->can('manager')) {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->Susers = User::where('name', 'like', $searchTerm)->get();

        return view('livewire.make-project', [
            'timeDiff' => new TimerService(),
            'projects' => Project::with('pManager')->get(),
            'tasks' => Task::all(),
            'aUsers' => User::paginate(10),
            'users' => User::when(count(array_filter($this->selectedUsers)), function ($query) {
                return $query->whereIn('name', $this->selectedUsers);
            })
        ]);
    } else {
        return view('livewire.make-project', [
            'timeDiff' => new TimerService(),
            'projects' => ProjectUser::where('user_id', Auth::id())->get(),
            'tasks' => Task::all(),
        ]);
        }
    }
}