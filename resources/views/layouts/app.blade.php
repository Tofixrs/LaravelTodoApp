<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_drop_down" />
        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="flex flex-col min-h-screen">
        @auth
            <nav class="navbar bg-base-300 px-10">
                <a class="btn btn-ghost text-xl" href="{{route("/")}}">Todo</a>
                <div class="grow"></div>
                <button class="cursor-pointer flex items-center" popovertarget="popover-1" style="anchor-name:--anchor-1">
                    <span>{{Auth::user()->name}}</span>
                    <span class="material-symbols-outlined">
                        arrow_drop_down
                    </span>
                </button>
                <ul class="dropdown menu w-52 rounded-box bg-base-100 shadow-sm"
                  popover id="popover-1" style="position-anchor:--anchor-1">
                    <li>
                        <form method="POST" action="/logout" class="flex">
                            @csrf
                            <input class="cursor-pointer h-full w-full text-left" type="submit" value="Logout">
                        </form>
                    </li>
                </ul>
            </nav>
        @endauth
        <main class="grow p-5 flex flex-col">
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>
