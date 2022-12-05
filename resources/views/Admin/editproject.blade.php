@extends('layouts.app1')
@livewireStyles
@section('content')
    <div>
        <livewire:update-project :project="$project"/>
    </div>
    @livewireScripts
@endsection



