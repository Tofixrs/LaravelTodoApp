<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;

Route::livewire("/register", "pages::auth.register")->name("register");
Route::livewire("/login", "pages::auth.login")->name("login");

Route::post("/register", [AuthWebController::class, 'register']);
Route::post("/login", [AuthWebController::class, 'login']);
Route::post("/logout", [AuthWebController::class, 'logout']);
