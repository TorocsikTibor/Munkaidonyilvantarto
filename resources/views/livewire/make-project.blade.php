<div>


    <form wire:submit.prevent="saveProject">
        @csrf

        <label class="input-group-text">Projekt név:</label>

        <input type="text" wire:model="name" />
        <label class="input-group-text">Projekt menedzser:</label>
        <select wire:model="pmanager_id">
            @foreach($aUsers as $user)
                @if($user->can('manager'))
                    <option value={{$user->id}}>{{$user->name}}</option>
                @endif
            @endforeach
        </select>

        <label class="input-group-text">Felhasználó hozzárendelés:</label>
        <input type="text" wire:model="searchTerm" />
            @foreach($Susers as $user)
            <br>
            <input type="checkbox" wire:model="selectedUsers" value="{{$user->id}}">{{$user->name}}
            <br>
            @endforeach

        @foreach($selectedUsers as $course)
            {{$course}}
        @endforeach
        <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Mentés">
    </form>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Név</th>
            <th scope="col">Projekt menedzser</th>
            <th scope="col">Timer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
        <tr>
            <th scope="row">{{$project->id}}</th>
            <td>{{$project->name}}</td>
            <td>{{$project->pManager->name}}</td>
            <td>
{{--                <button wire:click="createTimer({{$project->id}})" name="btn" class="btn btn-primary">Task</button>--}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
