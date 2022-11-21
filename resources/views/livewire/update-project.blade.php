<div>
    <form wire:submit.prevent="updateProject" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Név:</label>
            <input type="text" name="name" class="form-control" value="{{$project->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Menedzser:</label>
            <input type="number" name="pmanager_id" class="form-control" value="{{$project->pmanager_id}}">
        </div>
        <div class="mb-3">
            <div class="form-group">
                <label class="form-label">Leírás:</label>
                <textarea class="form-control" name="description" rows="3">{{$project->description}}</textarea>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Határidő:</label>
            <input type="date" name="deadline" class="form-control" value="{{$project->deadline}}">
        </div>
        <div class="mb-3">
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


        <div class="mb-3">
            <input type="submit" class="btn btn-success justify-content-end" name="action" value="Mentés">
        </div>
    </form>
</div>
