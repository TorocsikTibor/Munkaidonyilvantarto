@extends('layouts.app1')

@section('content')

    <form action='{{URL('admin/user/'.$user->id)}}' method="POST" >
        @csrf
        <div class="mb-3">
            <label class="form-label">Név</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="{{$user->email}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Szabadságok száma</label>
            <input type="number" name="leave_number" class="form-control" value="{{$user->leave_number}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Betegszabadságok</label>
            <input type="number" name="sick_leave" class="form-control" value="{{$user->sick_leave}}">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success btn-kuldes" value="Mentés">
        </div>
    </form>

@endsection
