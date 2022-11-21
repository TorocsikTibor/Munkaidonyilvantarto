<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Auth::user()->can('manager'))
        <div class="mb-5">
            <h1>Projektek</h1>
            <a href="{{ URL('/makeproject') }}" class="btn btn-danger">Projekt létrehozás</a>
        </div>
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
                                        <input class="form-control" style="max-width: 200px;" value="{{$project->name}}"
                                               disabled>
                                        <input class="form-control" style="max-width: 200px;"
                                               value="{{$project->pManager->name}}" disabled>
                                        <input class="form-control" style="max-width: 200px;"
                                               value="{{$project->deadline}}" disabled>
                                        <input class="form-control" style="max-width: 200px;"
                                               value="{{$project->description}}" disabled>
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
                                    <input type="submit" class="btn btn-success btn-kuldes" name="action"
                                           value="Mentés">
                                </form>
                            </div>
                            @if($project->tasks->count())
                                <table class="table table-striped">
                                    <thead>
                                    <th scope="col">Név</th>
                                    <th scope="col">Készítő</th>
                                    <th scope="col">Leaírás</th>
                                    <th scope="col">Kezdés</th>
                                    <th scope="col">Idő</th>
                                    </thead>
                                    <tbody>

                                    @foreach($project->tasks as $task)
                                        <tr>
                                            @if(\Illuminate\Support\Facades\Auth::id() === $task->user_id || \Illuminate\Support\Facades\Auth::user()->can('manager'))
                                                <td><a href="{{URL('/task/'.$task->id)}}">{{$task->name}}</a></td>
                                            @else
                                                <td>{{$task->name}}</td>
                                            @endif
                                            <td>{{$task->user->name}}</td>
                                            <td>{{$task->description}}</td>
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
                                <p>Nincs még feladat létrehozva!</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else

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
                                        <input class="form-control" style="max-width: 200px;" value="{{$project->name}}"
                                               disabled>
                                        <input class="form-control" style="max-width: 200px;"
                                               value="{{$project->pManager->name}}" disabled>
                                        <input class="form-control" style="max-width: 200px;"
                                               value="{{$project->deadline}}" disabled>
                                        <input class="form-control" style="max-width: 200px;"
                                               value="{{$project->description}}" disabled>
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
                                    <input type="submit" class="btn btn-success btn-kuldes" name="action"
                                           value="Mentés">
                                </form>
                            </div>
                            @if($project->tasks->count())
                                <table class="table table-striped">
                                    <thead>
                                    <th scope="col">Név</th>
                                    <th scope="col">Készítő</th>
                                    <th scope="col">Kezdés</th>
                                    <th scope="col">Idő</th>
                                    </thead>
                                    <tbody>
                                    @foreach($project->tasks as $task)
                                        <tr>
                                            @if(\Illuminate\Support\Facades\Auth::id() === $task->user_id || \Illuminate\Support\Facades\Auth::user()->can('manager'))
                                                <td><a href="{{URL('/task/'.$task->id)}}">{{$task->name}}</a></td>
                                            @else
                                                <td>{{$task->name}}</td>
                                            @endif
                                            <td>{{$task->user->name}}</td>
                                            <td>{{$task->timer_start}}</td>
                                            @if($task->timer_end == 0)
                                                    @if(\Illuminate\Support\Facades\Auth::id() === $task->user->id || \Illuminate\Support\Facades\Auth::user()->can('manager'))
                                                    <td>
                                                    <button wire:click="endTimer({{$task->id}}, 'withdrawn')" name="btn"
                                                            class="btn btn-danger">Stop
                                                    </button>
                                                </td>
                                                    @else
                                                        <td><p>Folyamatban</p></td>
                                                    @endif
                                            @else
                                                <td>{{$timeDiff->calculateTimeDifference($task->timer_start, $task->timer_end)}}</td>
                                            @endif
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @else
                                <p>Nincs még feladat létrehozva!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
