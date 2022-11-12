@extends('layouts.app1')
    @livewireStyles
@section('content')
    @can('admin')
        <h1>Szabadságok</h1>
    @endcan
    @can('user')
        <a href="{{ route('index') }}" class="btn btn-danger">Szabadság</a>
    @endcan
    <div>
        <livewire:show-leaves />
    </div>
    @livewireScripts
@endsection


