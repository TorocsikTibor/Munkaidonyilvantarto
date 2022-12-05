@extends('layouts.app1')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Projektek</h2>
                    <p class="card-text">Projektek száma: {{$projects}}</p>
                    <a href="{{URL('admin/projects')}}" class="card-link">Összes projekt</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Felhasználók</h2>
                    <p class="card-text">Felhasználók száma: {{$users}}</p>
                    <a href="{{URL('admin/users')}}" class="card-link">Összes felhasználó</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Szabadságok</h2>
                    <p class="card-text">Szabadságok száma: {{$leaves}}</p>
                    <a href="{{URL('admin/leaves')}}" class="card-link">Összes szabadság</a>
                </div>
            </div>
        </div>
    </div>
@endsection
