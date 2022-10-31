<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Név</th>
                <th scope="col">Kezdet</th>
                <th scope="col">Vég</th>
                <th scope="col">Leírás</th>
                <th scope="col">Státusz</th>
                <th scope="col">Típus</th>
                <th scope="col">Created_at</th>
                <th scope="col"> </th>
            </tr>
            </thead>
            <tbody>
                @if($leave)
                    @foreach($leave as $leaves)
                        <tr>
                        <th class="align-middle" scope="row">{{$leaves->Users->name}}</th>
                        <td class="align-middle">{{$leaves->start}}</td>
                        <td class="align-middle">{{$leaves->end}}</td>
                        <td class="align-middle">{{$leaves->desc}}</td>
                        <td class="align-middle">{{$leaves->status}}</td>
                        <td class="align-middle">{{$leaves->type}}</td>
                        <td class="align-middle">{{$leaves->created_at}}</td>
                        <td class="align-middle">

                            @can('manager')
                                    @if(\Illuminate\Support\Facades\Auth::id() != $leaves->users_id && $leaves->status === 'waiting_for_approval')
                                        <button wire:click="audit({{$leaves->id}}, 'decline')" name="btn" class="btn btn-danger">Elutasít</button>
                                        <button wire:click="audit({{$leaves->id}}, 'accept')" name="btn" class="btn btn-success">Elfogadás</button>
                                    @else
{{--                                    <button wire:click="audit({{$leaves->id}}, 'decline')" name="btn" class="btn btn-danger" disabled>Elutasít</button>--}}
{{--                                    <button wire:click="audit({{$leaves->id}}, 'accept')" name="btn" class="btn btn-success" disabled>Elfogadás</button>--}}
                                    @endif
                            @endcan
                                    @if(\Illuminate\Support\Facades\Auth::id() == $leaves->users_id && $leaves->status != 'withdrawn')
                                        <button wire:click="audit({{$leaves->id}}, 'withdrawn')" name="btn" class="btn btn-warning">Visszavonás</button>
                                    @else
                                    @endif
                        </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
</div>
