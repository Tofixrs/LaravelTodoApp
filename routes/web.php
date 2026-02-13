<?php

use App\Http\Controllers\ProfileController;
use App\TodoStatus;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $priority = [TodoStatus::Doing->value, TodoStatus::Todo->value, TodoStatus::Done->value];
    $todos = Auth::user()->todos->sortBy(function ($todo) use ($priority) {
        return array_search($todo->status, $priority);
    });

    return view('dashboard', ["todos" => $todos]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/todo.php';
