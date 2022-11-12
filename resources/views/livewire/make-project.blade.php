<div>

    @can('manager')

        <h1>Projekt létrehozása</h1>
        <form wire:submit.prevent="saveProject">
            @csrf
            <div class="mb-3">
                <label class="form-label">Projekt név:</label>
                <input type="text" class="form-control" wire:model="name"/>
            </div>
            <div class="mb-3">
                <label class="form-label">Projekt menedzser:</label>
                <select wire:model="pmanager_id" class="form-select">
                    @foreach($aUsers as $user)
                        @if($user->can('manager'))
                            <option value={{$user->id}}>{{$user->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Felhasználó hozzárendelés:</label>
                <br>
                <label class="form-label">Kereső:</label>
                <input type="text" class="form-control" wire:model="searchTerm"/>
            </div>


            @foreach($Susers as $user)
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" wire:model="selectedUsers"
                               value="{{$user->id}}" aria-label="Checkbox for following text input">
                    </div>
                    <span class="input-group-text">{{$user->name}}</span>
                </div>
            @endforeach

            @foreach($selectedUsers as $course)
                {{$course}}
            @endforeach
            <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Mentés">
        </form>

    @endcan

        @if(\Illuminate\Support\Facades\Auth::user()->can('manager'))
            @foreach($projects as $project)

    <div class="accordion mb-4" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne{{$project->id}}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne{{$project->id}}" aria-expanded="true"
                        aria-controls="collapseOne{{$project->id}}">
                    <h3>{{$project->name}}</h3>

                </button>
            </h2>

            <div id="collapseOne{{$project->id}}" class="accordion-collapse collapse show"
                 aria-labelledby="headingOne{{$project->id}}" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form>
                        <div class="row">
                        <div class="input-group col-md-3 mb-3">
                        <input class="form-control" style="max-width: 200px;" value="{{$project->name}}" disabled>
                        </div>
                        </div>
                    </form>

                    <div class="dropdown d-flex justify-content-end">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-auto-close="outside">
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
                    @if($project->tasks->count())
                    <table class="table table-striped">
                        <thead>
                        <th scope="col">Név</th>
                        <th scope="col">Kezdés</th>
                        <th scope="col">Idő</th>
                        </thead>
                        <tbody>

                        @foreach($project->tasks as $task)
                            <tr>
                                <td><a href="{{URL('/task/'.$task->id)}}">{{$task->name}}</a></td>
                                <td>{{$task->timer_start}}</td>
                                @if($task->timer_end == 0)
                                    <td>
                                        <button wire:click="endTimer({{$task->id}}, 'withdrawn')" name="btn"
                                                class="btn btn-danger">Stop
                                        </button>
                                    </td>
                                @else
                                    <td>{{$timeDiff->calculateTimeDifference($task->timer_start, $task->timer_end)}}</td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @else
                    <p>Nincs még feladat létrehozva</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @endforeach









    @else
        <tbody>
        @foreach($projects as $project)
            <tr>
                <th scope="row">{{$project->project->id}}</th>
                <td>{{$project->project->name}}</td>
                <td>{{$project->project->pManager->name}}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-auto-close="outside">
                            Timer
                        </button>
                        <form wire:submit.prevent="createTimer({{$project->project->id}})" class="dropdown-menu p-4">
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
            @foreach($project->tasks as $task)
                <tr>
                    <td><a href="{{URL('/task/'.$task->id)}}">{{$task->name}}</a></td>
                    <td>{{$task->timer_start}}</td>
                    @if($task->timer_end == 0)
                        <td>
                            <button wire:click="endTimer({{$task->id}}, 'withdrawn')" name="btn" class="btn btn-danger">
                                Stop
                            </button>
                        </td>
                    @else
                        <td>{{$timeDiff->calculateTimeDifference($task->timer_start, $task->timer_end)}}</td>
                    @endif
                </tr>
            @endforeach
        @endforeach
        @endif
        </tbody>
        </table>
</div>