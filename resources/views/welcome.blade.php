<x-guest-layout>
    <h1 class="text-white text-center text-4xl font-bold p-10">Simple todo app</h1>
    <div class="flex justify-center gap-5">
        <x-primary-button-link href="{{ route('login') }}">Login</x-primary-button-link>
        <x-secondary-button-link href="{{route('register')}}">Register</x-secondary-button-link>
    </div>
</x-guest-layout>
