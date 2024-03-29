@extends('layouts.app1')

@section('content')
    <h2>Felhasználók</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Név</th>
            <th scope="col">Email</th>
            <th scope="col">Munka megkezdése</th>
            <th scope="col">Születésnap</th>
            <th scope="col">Gyerekek száma</th>
            <th scope="col">Szabadság</th>
            <th scope="col">Beteg szabadság</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td class="align-middle">{{$user->name}}</td>
                    <td class="align-middle">{{$user->email}}</td>
                    <td class="align-middle">{{$user->leaveCalculate->starting_work}}</td>
                    <td class="align-middle">{{$user->leaveCalculate->birthday}}</td>
                    <td class="align-middle">{{$user->leaveCalculate->children}}</td>
                    <td class="align-middle">{{$user->leave_number}}</td>
                    <td class="align-middle">{{$user->sick_leave}}</td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center justify-content-start">
                        <a href="{{URL('/admin/user/'.$user->id)}}" class="btn btn-primary me-3">Módosít</a>
                        <form action='{{URL('/admin/user/'.$user->id)}}' method="POST" >
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Törlés">
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
