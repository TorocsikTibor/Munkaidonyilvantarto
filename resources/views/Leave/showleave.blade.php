@extends('layouts.app1')
    @livewireStyles
@section('content')
    @can('admin')
        <h1>Új szabadságok</h1>
    @endcan
        <a href="{{ route('index') }}" class="btn btn-danger">Szabadság</a>
    <div>
        <livewire:show-leaves />
    </div>
    @livewireScripts
@endsection


