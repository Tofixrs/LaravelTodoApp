<?php

namespace App\Models;

enum TodoStatus: string
{
    case Todo = "todo";
    case Doing = "doing";
    case Done = "done";
}
