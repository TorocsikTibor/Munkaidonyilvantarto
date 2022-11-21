<div>
    @can('manager')

        <h1>Projekt létrehozása</h1>
        <form wire:submit.prevent="saveProject">
            @csrf
            <div class="mb-3">
                <label class="form-label">Projekt név:</label>
                <input type="text" class="form-control" wire:model="name"/>
            </div>
            <div class="mb-3">
                <label class="form-label">Projekt menedzser:</label>
                <select wire:model="pmanager_id" class="form-select">
                    @foreach($aUsers as $user)
                        @if($user->can('manager'))
                            <option value={{$user->id}}>{{$user->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Leírás:</label>
                    <textarea class="form-control" wire:model="description" rows="3"></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Határidő:</label>
                <input type="date" class="form-control" wire:model="deadline"/>
            </div>

            <div class="mb-3">
                <label class="form-label">Felhasználó hozzárendelés:</label>
                <br>
                <label class="form-label">Kereső:</label>
                <input type="text" class="form-control" wire:model="searchTerm"/>
            </div>

            @foreach($Susers as $user)
                <div class="input-group mb-3 ">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" wire:model="selectedUsers"
                               value="{{$user->id}}" aria-label="Checkbox for following text input">
                    </div>
                    <span class="input-group-text">{{$user->name}}</span>
                </div>
            @endforeach

            @foreach($selectedUsers as $course)
                {{$course}}
            @endforeach


            <input type="submit" class="btn btn-success justify-content-end" name="action" value="Mentés">
        </form>
    @endcan
</div>
