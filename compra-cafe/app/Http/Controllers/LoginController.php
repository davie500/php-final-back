<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string|min:8',
        ]);
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (!Hash::check($request->senha, $user->senha_hash)) {
            return response()->json(['message' => 'Senha incorreta'], 401);
        }
        
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'message' => 'Usuário logado com sucesso',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }
}