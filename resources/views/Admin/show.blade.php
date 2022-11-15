@extends('layouts.app1')

@section('content')
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h2 class="card-title">Projektek</h2>
            <p class="card-text">{{$projects}}</p>
            <a href="{{URL('admin/projects')}}" class="card-link">Összes projekt</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h2 class="card-title">Felhasználók</h2>
            <p class="card-text">{{$users}}</p>
            <a href="{{URL('admin/users')}}" class="card-link">Összes felhasználó</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h2 class="card-title">Szabadságok</h2>
            <p class="card-text">{{$leaves}}</p>
            <a href="{{URL('admin/leaves')}}" class="card-link">Összes szabadság</a>
        </div>
    </div>
@endsection
