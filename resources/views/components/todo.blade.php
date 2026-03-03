<?php

use Livewire\Component;
use App\Models\Todo;
use App\Models\TodoStatus;

new class extends Component {
    public bool $editing = false;
    public Todo $todo;
    public string $selectedStatus;
    public function mount(
        Todo $todo
    ) {
        $this->todo = $todo;
        $this->selectedStatus = $todo->status;
    }

    public function edit() {
        $this->editing = true;
    }
};
?>

<li class="list-row" wire:dblclick="edit" class="flex gap-5">
    <div>
        <form method="POST" id="saveForm" action="/todo/{{$todo->id}}" class="flex gap-5">
            @csrf
            @method("patch")
            @if($editing)
                <input type="text" name="name" value="{{$todo->name}}" class="input"/>
            @endif
            <input type="hidden" name="status" value="{{$selectedStatus}}" class="input">
        </form>
        @unless($editing)
            <div class="flex items-center h-full">
                <p>{{$todo->name}}</p>
            </div>
        @endunless
    </div>
    <div>
        <select class="select" wire:model.live="selectedStatus">
            @foreach (TodoStatus::cases() as $status)
                <option value="{{$status}}">{{$status}}</option>
            @endforeach
        </select>
    </div>
    <div class="flex gap-5">
        @if ($editing || $todo->status != $selectedStatus)
            <input type="submit" value="Save" form="saveForm" class="btn btn-neutral" />
        @endif
        <form method="POST" action="/todo/{{$todo->id}}">
            @csrf
            @method("delete")
            <input type="submit" value="Delete" class="btn btn-warning">
        </form>
    </div>
</li>
