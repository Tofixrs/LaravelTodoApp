<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\TodoController;

Route::post("/api/register", [AuthApiController::class, 'register']);
Route::post("/api/login", [AuthApiController::class, 'login']);

Route::group(["middleware" => "auth:api"], function () {
    Route::get("/api/me", [AuthApiController::class, 'me']);
    Route::get("/api/me/todos", [TodoController::class, 'getMyTodos']);
    Route::post("/api/refresh", [AuthApiController::class, 'refresh']);
    Route::post("/api/logout", [AuthApiController::class, 'logout']);
});
