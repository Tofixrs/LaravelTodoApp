<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public function mount() {
        if (!is_null(Auth::user())) {
            $this->skipRender();
            return $this->redirect("/dashboard");
        }
    }
};
?>
<div class="w-screen h-screen grid place-items-center">
    <form method="POST">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-lg border p-4">
            <legend class="fieldset-legend">Login</legend>
            <label class="input w-full" for="email">
                <span class="label">Email</span>
                <input type="email" name="email" id="email">
            </label>
            <label class="input w-full" for="password">
                <span class="label">Password</span>
                <input type="password" name="password" id="password">
            </label>
            <input class="btn btn-primary" type="submit" value="Login">
            <div class="flex justify-end">
                <a class="link" href="{{route("register")}}">Register instead</a>
            </div>
        </fieldset>
    </form>
</div>
