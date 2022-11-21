@extends('layouts.app1')

@section('content')

    <h2>Projektek</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Név</th>
            <th scope="col">Projekt vezető</th>
            <th scope="col">Leírás</th>
            <th scope="col">Határidő</th>
            <th scope="col">Módosítás</th>
        </tr>
        </thead>
        <tbody>
        @if($projects)
            @foreach($projects as $project)
                <tr>
                    <td class="align-middle">{{$project->name}}</td>
                    <td class="align-middle">{{$project->pManager->name}}</td>
                    <td class="align-middle">{{$project->description}}</td>
                    <td class="align-middle">{{$project->deadline}}</td>
                    <td class="align-middle">
                        <a href="{{URL('/admin/project/'.$project->id)}}" class="btn btn-primary">Módosít</a>
                        <form action="{{URL('/admin/project/'.$project->id)}}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Törlés">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
