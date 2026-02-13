<?php

namespace App;

enum TodoStatus: string
{
    case Todo = "todo";
    case Doing = "doing";
    case Done = "done";
}
