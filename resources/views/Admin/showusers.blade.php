@extends('layouts.app1')

@section('content')
    <h2>Felhasználók</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Név</th>
            <th scope="col">Email</th>
            <th scope="col">Szabadság</th>
            <th scope="col">Beteg szabadság</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td class="align-middle">{{$user->name}}</td>
                    <td class="align-middle">{{$user->email}}</td>
                    <td class="align-middle">{{$user->leave_number}}</td>
                    <td class="align-middle">{{$user->sick_leave}}</td>
                    <td class="align-middle">
                        <a href="{{URL('/admin/user/'.$user->id)}}" class="btn btn-primary">Módosít</a>
                        <form action='{{URL('/admin/user/'.$user->id)}}' method="POST" >
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Törlés">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
