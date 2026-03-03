<?php

use Livewire\Component;
use App\Models\TodoStatus;

new class extends Component
{
    public bool $modalOpen = false;
    public function render() {
        $priority = [TodoStatus::Doing->value, TodoStatus::Todo->value, TodoStatus::Done->value];
        $todos = Auth::user()->todos->sortBy(function ($todo) use ($priority) {
            return array_search($todo->status, $priority);
        });

        return $this->view([
            "todos" => $todos
        ]);
    }
};
?>
@script
    <script>
    $js("showAddModal", () => {
        document.getElementById("dialog").showModal();
    });
    </script>
@endscript
<div class="flex justify-center">
    <div class="w-3/4">
        <ul class="list bg-base-100 rounded-box shadow-md">
            <li class="p-4 pb-2 text-s opacity-60 tracking-wide">Your todos</li>
            @forelse ($todos as $todo)
                <livewire:todo :todo="$todo" :key="$todo->id"/>
            @empty
                <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">No todos</li>
            @endforelse
        </ul>
        <div class="flex justify-end p-5">
            <button class="btn btn-neutral" wire:click="$js.showAddModal">Add todo</button>
        </div>

        <dialog id="dialog" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Add Todo</h3>
                <form method="POST" id="addTodoForm" action="/todo" class="flex">
                    @csrf
                    <input class="input grow" type="text" name="name">
                </form>
                <div class="modal-action">
                    <input class="btn btn-primary"type="submit" form="addTodoForm" value="Add new todo">
                    <form method="dialog">
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
</div>
