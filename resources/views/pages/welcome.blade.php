
<?php

use Livewire\Component;
use App\Models\TodoStatus;

new class extends Component
{
};
?>
<div class="grow grid place-items-center">
    <div class="flex flex-col gap-10">
        <h1 class="text-8xl font-bold text-center">TodoApp</h1>
        <div class="grid grid-cols-2 gap-5 justify-center">
            <a class="btn btn-primary" href="{{route("login")}}">Login</a>
            <a class="btn btn-secondary" href="{{route("register")}}">Register</a>
        </div>
    </div>
</div>
