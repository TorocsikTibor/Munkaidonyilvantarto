@extends('layouts.app1')

@section('content')
    <form action=action='{{URL('/task/'.$task->id)}}' method="POST" >
        @csrf

        <div class="mb-3">
            <label for="exampleDropdownFormEmail2" class="form-label">ID:</label>
            <input type="text" name="id" class="form-control" value="{{$task->id}}">
        </div>
        <div class="mb-3">
            <label for="exampleDropdownFormEmail2" class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="{{$task->name}}">
        </div>
        <div class="mb-3">
            <label for="exampleDropdownFormEmail2" class="form-label">Description:</label>
            <input type="text" name="description" class="form-control" value="{{$task->description}}">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success btn-kuldes" value="Mentés">
        </div>
    </form>
@endsection
