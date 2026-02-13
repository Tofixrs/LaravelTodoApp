@php
use App\TodoStatus;

@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('dashboard.your_todos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-5">
                @forelse ($todos as $todo)
                    <div class="flex">
                        <span>{{$todo["name"]}}</span>
                        <span class="flex-grow"></span>

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ __("todo.status_" . $todo["status"]) }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                            @foreach (TodoStatus::cases() as $item)
                                <!-- Authentication -->
                                <form method="POST" action="/todo/{{$todo["id"]}}">
                                    @csrf
                                    @method("patch")
                                    <input type="hidden" name="status" value="{{$item->value}}">

                                    <x-dropdown-link
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __("todo.status_" . $item->value) }}
                                    </x-dropdown-link>
                                </form>
                            @endforeach
                            </x-slot>
                        </x-dropdown>
                        <form method="POST" action="/todo/{{$todo["id"]}}">
                            @csrf
                            @method("delete")
                            <x-danger-button role="submit">{{__("dashboard.todo_delete")}}</x-danger-button>
                        </form>
                    </div>
                @empty
                    <h1>Nothing to do!</h1>
                @endforelse
                <form method="POST" action="/todo">
                    @csrf
                    <x-input-label for="name">{{__("dashboard.todo_name")}}</x-input-label>
                    <div class="flex items-center gap-5">
                        <x-text-input id="name" name="name"/>
                        <x-primary-button role="submit">{{__("dashboard.todo_add")}}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
