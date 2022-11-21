<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateProject extends Component
{
    public $project;
    public $selectedUsers = [];
    public $searchTerm;
    public $Susers;

    public function updateProject()
    {
        $allUser = ProjectUser::where('project_id', $this->project->id)->delete();

        foreach ($this->selectedUsers as $this->arrayUser) {
            $selectedUser = new ProjectUser();
            $selectedUser->project_id = $this->project->id;
            $selectedUser->user_id = $this->arrayUser;
            $selectedUser->save();
        }


        if(Auth::user()->can('admin'))
        {
            return redirect()->to('admin/projects');
        } else {
            return redirect()->to('manager');
        }

    }

    public function mount($project)
    {
        foreach ($project->user as $user) {
            $this->selectedUsers[] = $user->id;
        }
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->Susers = User::where('name', 'like', $searchTerm)->get();

        return view('livewire.update-project', [
            'users' => User::when(count(array_filter($this->selectedUsers)), function ($query) {
                return $query->whereIn('name', $this->selectedUsers);
            })
        ]);
    }
}
