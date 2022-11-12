@extends('layouts.app1')

@section('content')
<form action='{{URL('/task/'.$task->id)}}' method="POST" >
        @csrf
        <label for="exampleDropdownFormEmail2" class="form-label">ID:</label>
        <input type="text" name="id" class="form-control" value="{{$task->id}}">

        <label for="exampleDropdownFormEmail2" class="form-label">Name:</label>
        <input type="text" name="name" class="form-control" value="{{$task->name}}">

        <label for="exampleDropdownFormEmail2" class="form-label">Description:</label>
        <input type="text" name="description" class="form-control" value="{{$task->description}}">

        <input type="submit" class="btn btn-success btn-kuldes" value="Mentés">
</form>
@endsection
