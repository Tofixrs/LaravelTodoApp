<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthApiController extends Controller
{
    public function __construct()
    {
    }
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

        return request()->json(["success" => true]);
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => ["required", "string", "email:rfc,dns", "max:255"],
            "password" => ["required", "string"]
        ]);

        $credentials = request(["email", "password"]);

        if (! $token = Auth::guard("api")->attempt($credentials)) {
            return response()->json(["errors" => ["auth" => "Unauthorized"]], 401);
        }

        return $this->respondWithToken($token);

    }
    public function me()
    {
        return response()->json(auth("api")->user());
    }
    public function logout()
    {
        auth("api")->logout();

        return response()->json(['success' => true]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth("api")->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("api")->factory()->getTTL() * 60
        ]);
    }
}
