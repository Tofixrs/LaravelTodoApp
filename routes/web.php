<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', "pages::welcome")->name("/");



Route::group(["middleware" => "auth:web"], function () {
    Route::livewire("/dashboard", "pages::dashboard");
});


require __DIR__."/auth/api.php";
require __DIR__."/auth/web.php";
require __DIR__."/todo.php";
