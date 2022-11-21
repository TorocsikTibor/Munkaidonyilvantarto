@extends('layouts.app1')
@livewireStyles
@section('content')

    <livewire:update-project :project="$project" />
    @livewireScripts
@endsection
