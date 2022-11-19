@extends('layouts.app1')

@section('content')

    <form action='{{URL('/admin/project/'.$project->id)}}' method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Név:</label>
            <input type="text" name="name" class="form-control" value="{{$project->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Menedzser:</label>
            <input type="number" name="pmanager_id" class="form-control" value="{{$project->pmanager_id}}">
        </div>
        <div class="mb-3">
            <div class="form-group">
                <label class="form-label">Leírás:</label>
                <textarea class="form-control" name="description" rows="3">{{$project->description}}</textarea>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Határidő:</label>
            <input type="date" name="deadline" class="form-control" value="{{$project->deadline}}">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success btn-kuldes" value="Mentés">
        </div>
    </form>

@endsection
