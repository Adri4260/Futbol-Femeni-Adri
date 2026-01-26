<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validem que arriben les dades
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentem fer login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credencials incorrectes'], 401);
        }

        // Recuperem l'usuari
        $user = User::where('email', $request['email'])->firstOrFail();

        // borra tokens anteriors
        $user->tokens()->delete();

        // Crea un token nou
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hola ' . $user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sessió tancada']);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
            'role' => $request->user()->role,
            'team_id' => $request->user()->team_id
        ]);
    }
}
