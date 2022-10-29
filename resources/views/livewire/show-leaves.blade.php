<div>
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
                        <th scope="row">{{$leaves->Users->name}}</th>
                        <td>{{$leaves->start}}</td>
                        <td>{{$leaves->end}}</td>
                        <td>{{$leaves->desc}}</td>
                        <td>{{$leaves->status}}</td>
                        <td>{{$leaves->type}}</td>
                        <td>{{$leaves->created_at}}</td>
                        <td><button wire:click="audit({{$leaves->id}}, 'decline')" name="btn" class="btn btn-danger">Elutasít</button>
                            <button wire:click="audit({{$leaves->id}}, 'accept')" name="btn" class="btn btn-success">Elfogadás</button>
                            <button wire:click="audit({{$leaves->id}}, 'withdrawn')" name="btn" class="btn btn-warning">Visszavonás</button>
                        </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
</div>
