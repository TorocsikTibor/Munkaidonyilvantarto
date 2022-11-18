@extends('layouts.app1')

@section('content')
    <div class="mb-5">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title">Projektek</h2>
                <p class="card-text">{{$project}}/{{$nOwnProject}}</p>
                <a href="#" class="card-link">Card link</a>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <h2>Saját projektek</h2>
    </div>
    @foreach($ownProjects as $project)

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
                                    <input class="form-control" style="max-width: 200px;"
                                           value="{{$project->deadline}}" disabled>
                                    <input class="form-control" style="max-width: 200px;"
                                           value="{{$timeDiff->getAllTime($project->tasks)}}" disabled>
                                    <div class="mb-3">
                                        <a href="{{URL('/admin/project/'.$project->id)}}" class="btn btn-primary">Módosít</a>
                                        <form action='{{URL('/admin/project/'.$project->id)}}' method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="Törlés">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if($project->user->count())
                            <h3>Projekten dolgozók száma: {{$project->user->count()}}</h3>
                            <table class="table table-striped">
                                <thead>
                                <th scope="col">Név</th>
                                <th scope="col">Dolgozott idő</th>
                                </thead>
                                <tbody>
                                @foreach($project->user as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$timeDiff->getUserTime($user->id, $project->tasks)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if($project->tasks->count())
                            <h3>Feladatok</h3>
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
                                            <td>Folyamatban...</td>
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
@endsection
