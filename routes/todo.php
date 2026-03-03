<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::group(["middleware" => "auth:web"], function () {
    Route::post("/todo", [TodoController::class, "create"]);
    Route::delete("/todo/{todo}", [TodoController::class, "delete"]);
    Route::patch("/todo/{todo}", [Todocontroller::class, "update"]);
});

Route::group(["middleware" => "auth:api"], function () {
    Route::post("/api/todo", [Todocontroller::class, "create"]);
    Route::delete("/api/todo/{todo}", [Todocontroller::class, "delete"]);
    Route::patch("/api/todo/{todo}", [Todocontroller::class, "update"]);
});
