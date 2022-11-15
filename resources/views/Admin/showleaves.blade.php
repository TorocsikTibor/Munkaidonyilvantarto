@extends('layouts.app1')

@section('content')
    <h2>Felhasználók</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Felhasználó id</th>
            <th scope="col">Kezdet</th>
            <th scope="col">Vég</th>
            <th scope="col">Leírás</th>
            <th scope="col">Tipus</th>
            <th scope="col">Státusz</th>
        </tr>
        </thead>
        <tbody>
        @if($leaves)
            @foreach($leaves as $leave)
                <tr>
                    <td class="align-middle">{{$leave->users_id}}</td>
                    <td class="align-middle">{{$leave->start}}</td>
                    <td class="align-middle">{{$leave->end}}</td>
                    <td class="align-middle">{{$leave->desc}}</td>
                    <td class="align-middle">{{$leave->type}}</td>
                    <td class="align-middle">{{$leave->status}}</td>
                    <td class="align-middle">
                        <a href="{{URL('/admin/leave/'.$leave->id)}}" class="btn btn-primary">Módosít</a>
                        <form action='{{URL('/admin/leave/'.$leave->id)}}' method="POST" >
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
