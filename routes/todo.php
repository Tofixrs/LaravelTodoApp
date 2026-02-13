<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post("/todo", [TodoController::class, "create"])->middleware(["auth", 'verified']);
Route::delete("/todo/{todo}", [TodoController::class, "delete"])->middleware(["auth", 'verified']);
Route::patch("/todo/{todo}", [TodoController::class, "updateStatus"])->middleware(["auth", 'verified']);
