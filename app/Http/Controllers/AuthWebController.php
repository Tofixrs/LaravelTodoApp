<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthWebController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string","email:rfc,dns", "unique:users"],
            "password" => ["required", "string", "max:255", "min:8", Password::default()],
            "confirm_password"  => ["required", "string", "max:255", "same:password"]
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return redirect("/login");
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => ["required", "string", "email:rfc,dns", "max:255"],
            "password" => ["required", "string"]
        ]);

        $credentials = request(["email", "password"]);

        if (Auth::guard("web")->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("dashboard");
        }

        return back()->withErrors(["error" => "Invalid credentials"]);
    }
}
