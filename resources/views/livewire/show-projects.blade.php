<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-5">
        <h1>Projektek</h1>
        @if(\Illuminate\Support\Facades\Auth::user()->can('manager'))


            <a href="{{ URL('/makeproject') }}" class="btn btn-danger">Projekt létrehozás</a>
    </div>

    @foreach($projects as $key=>$project)

        <div class="accordion mb-4" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne{{$project->id}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne{{$project->id}}"
                            aria-expanded="{{  ($key == 0) ? 'true' : 'false' }}"
                            aria-controls="collapseOne{{$project->id}}">
                        <h3>{{$project->name}}</h3>
                    </button>
                </h2>

                <div id="collapseOne{{$project->id}}"
                     class="accordion-collapse collapse {{  ($key == 0) ? 'show' : '' }}"
                     aria-labelledby="headingOne{{$project->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"
                                                 style="
    width: 100%;
    max-width: 40%;
    height: auto;">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd"
                                                      d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$project->pmanager->name}}</h5>
                                                <p><small>Projekt vezető</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16"
                                                 style="
    width: 100%;
    max-width: 40%;
    height: auto;">
                                                <path
                                                    d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$project->deadline}}</h5>
                                                <p><small>Határidő</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16"
                                                 style="
    width: 100%;
    max-width: 30%;
    height: auto;">
                                                <path
                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path
                                                    d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <h5 class="card-title">Leírás</h5>
                                                <p class="card-text">{{$project->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-flex justify-content-end">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false" data-bs-auto-close="outside">
                                Új feladat
                            </button>
                            <form wire:submit.prevent="createTimer({{$project->id}})" class="dropdown-menu p-4">
                                <div class="mb-3">
                                    <label for="exampleDropdownFormEmail2" class="form-label">Feladat neve:</label>
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
                                <th scope="col">Leírás</th>
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
                                    <input type="submit" class="btn btn-success" name="action" value="Mentés">
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
                                                        <button wire:click="endTimer({{$task->id}}, 'withdrawn')"
                                                                name="btn"
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
