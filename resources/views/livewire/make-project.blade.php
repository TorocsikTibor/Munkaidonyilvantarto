<div>


    <form wire:submit.prevent="saveProject">
        @csrf

        <label class="input-group-text">Projekt név:</label>

        <input type="text" wire:model="name" />
        <label class="input-group-text">Projekt menedzser:</label>
        <select wire:model="pmanager_id">
            @foreach($aUsers as $user)
                @if($user->can('manager'))
                    <option value={{$user->id}}>{{$user->name}}</option>
                @endif
            @endforeach
        </select>

        <label class="input-group-text">Felhasználó hozzárendelés:</label>
        <input type="text" wire:model="searchTerm" />
            @foreach($Susers as $user)
            <br>
            <input type="checkbox" wire:model="selectedUsers" value="{{$user->id}}">{{$user->name}}
            <br>
            @endforeach

        @foreach($selectedUsers as $course)
            {{$course}}
        @endforeach
        <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Mentés">
    </form>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Név</th>
            <th scope="col">Projekt menedzser</th>
            <th scope="col">Timer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
        <tr>
            <th scope="row">{{$project->id}}</th>
            <td>{{$project->name}}</td>
            <td>{{$project->pManager->name}}</td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        Timer
                    </button>
                    <form wire:submit.prevent="createTimer({{$project->id}})" class="dropdown-menu p-4">
                        <div class="mb-3">
                            <label for="exampleDropdownFormEmail2" class="form-label">Name:</label>
                            <input type="text" class="form-control" wire:model="taskName">
                        </div>
                        <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Mentés">
                    </form>
                </div>
{{--                <button wire:click="createTimer({{$project->id}})" name="btn" class="btn btn-primary">Task</button>--}}
            </td>
        </tr>
            @foreach($tasks as $task)
            <tr>
                <td><a href="{{URL('/task/'.$task->id)}}">{{$task->name}}</a></td>
                <td>{{$task->timer_start}}</td>
                @if($task->timer_end == 0)
                <td> <button wire:click="endTimer({{$task->id}}, 'withdrawn')" name="btn" class="btn btn-danger">Stop</button></td>
                @else
                    <td>{{$timeDiff->calculateTimeDifference($task->timer_start, $task->timer_end)}}</td>
                @endif
            </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
