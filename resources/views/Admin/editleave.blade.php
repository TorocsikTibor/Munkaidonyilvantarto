@extends('layouts.app1')

@section('content')

    <form action='{{URL('admin/leave/'.$leave->id)}}' method="POST" >
        @csrf
        <div class="mb-3">
            <label class="form-label">Kezdet</label>
            <input type="date" name="start" class="form-control" value="{{$leave->start}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vég</label>
            <input type="date" name="end" class="form-control" value="{{$leave->end}}">
        </div>
        <div class="mb-3">
            <div class="form-group">
                <label class="form-label">Leírás</label>
                <textarea class="form-control" name="desc" rows="3">{{$leave->desc}}</textarea>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipus</label>
            <input type="number" name="type" class="form-control" value="{{$leave->type}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Státusz</label>
            <input type="text" name="status" class="form-control" value="{{$leave->status}}">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success btn-kuldes" value="Mentés">
        </div>
    </form>
@endsection
