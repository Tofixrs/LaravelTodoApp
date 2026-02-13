<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\TodoStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    public function delete(Request $request, Todo $todo)
    {
        if ($request->user()->cannot("delete", $todo)) {
            abort(403);
        }
        $todo->delete();
        return redirect("/dashboard");
    }
    public function create(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);
        Todo::create([
            "name" => $request["name"],
            "user_id" => $request->user()["id"]
        ]);
        return redirect("/dashboard");
    }
    public function updateStatus(Request $request, Todo $todo)
    {
        $request->validate([
            "status" => [Rule::enum(TodoStatus::class)]
        ]);
        $todo["status"] = $request["status"];
        $todo->save();
        return redirect("/dashboard");
    }
}
