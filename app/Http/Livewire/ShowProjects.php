<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Services\TimerService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowProjects extends Component
{

    public $taskName;

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

    public function render()
    {
        if(Auth::user()->can('manager')) {
            return view('livewire.show-projects', [
                'timeDiff' => new TimerService(),
                'projects' => Project::with('pManager')->get(),
            ]);
        } else {
            return view('livewire.make-project', [
                'timeDiff' => new TimerService(),
                'projects' => ProjectUser::where('user_id', Auth::id())->get(),
            ]);
        }
    }
}
