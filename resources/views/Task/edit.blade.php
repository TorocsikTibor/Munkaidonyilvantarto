@extends('layouts.app1')

@section('content')
    <h2>Feladat szerkesztése</h2>
    <form action='{{URL('/task/'.$task->id)}}' method="POST" >
        @csrf
        <div class="mb-3">
            <label for="exampleDropdownFormEmail2" class="form-label">Név:</label>
            <input type="text" name="name" class="form-control" value="{{$task->name}}">
        </div>
        <div class="mb-3">
            <label for="exampleDropdownFormEmail2" class="form-label">Leírás:</label>
            <input type="text" name="description" class="form-control" value="{{$task->description}}">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="Mentés">
        </div>
    </form>

    <form action='{{URL('/task/'.$task->id)}}' method="POST" >
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Törlés">

    </form>
@endsection
