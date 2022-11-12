@extends('layouts.app1')
    @livewireStyles
@section('content')

    <div>
        <form action="{{ route('makeleave') }}" method="post" >
            @csrf
            <div class="mb-3">
            <label class="form-label">Típus:</label>
            <select class="form-select" name="type" id="type">
                <option value=1 >Fizetett szabadság</option>
                <option value=2 >Betegszabadság</option>
            </select>
            </div>
                <div class="mb-3">
            <label class="form-label">Kezdet:</label>
            <input type="date" class="form-control" name="start" />
                </div>
                    <div class="mb-3">
                    <label class="form-label">Vég:</label>
            <input type="date" class="form-control" name="end" />
                    </div>
            <div class="mb-3">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Leírás:</label>
                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            </div>
            <div class="mb-3">
            <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Mentés">
            <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Draft">
            </div>
        </form>

    </div>

@endsection
