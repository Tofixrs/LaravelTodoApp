<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\TodoStatus;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            "name" => ["required", "max:50"]
        ]);
        $todo = Todo::create([
            "name" => $request->name,
            "user_id" => $request->user()->id,
            "status" => null
        ]);
        $todo = $todo->refresh();

        return $request->expectsJson()
            ? response()->json(["success" => true, "todo" => $todo])
            : redirect("/dashboard");
    }
    public function delete(Request $request, Todo $todo)
    {
        if ($request->user()->cannot("delete", $todo)) {
            abort(403);
        }
        $todo->delete();

        return $request->expectsJson()
            ? response()->json(["success" => true])
            : redirect("/dashboard");
    }
    public function getMyTodos(Request $request)
    {
        return response()->json(Auth::user()->todos);
    }
    public function update(Request $request, Todo $todo)
    {
        if ($request->user()->cannot("update", $todo)) {
            abort(403);
        }

        $request->validate([
            "status" => [Rule::enum(TodoStatus::class)],
            "name" => ["max:50"]
        ]);
        if (!is_null($request->name)) {
            $todo->name = $request->name;
        }
        if (!is_null($request->status)) {
            $todo->status = $request->status;
        }
        $todo->save();
        return $request->expectsJson()
            ? response()->json(["success" => true, "todo" => $todo])
            : redirect("/dashboard");
    }


}
