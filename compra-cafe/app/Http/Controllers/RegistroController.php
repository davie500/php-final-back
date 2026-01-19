<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fila;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function buscar(Request $request)
    {
        $auth = $request->user();
        if ($auth->admin) {
            $usuarios = User::all();
            return response()->json(['message' => 'Listando usuários e administradores', 'data' => $usuarios], 200);
        } else {
            $usuarios = User::where('admin', false)->get();
            return response()->json(['message' => 'Listando usuários', 'data' => $usuarios], 200);
        }
    }

    public function registro(UserRequest $request)
    {
        $data = $request->validated();
        $adminValue = isset($data['admin']) ? filter_var($data['admin'], FILTER_VALIDATE_BOOLEAN) : false;
        $user = User::create([
            'nome' => $data['nome'],
            'email'  => $data['email'],
            'senha_hash' => Hash::make($data['senha_hash']),
            'admin' => $adminValue,
        ]);
        $fila = Fila::adicionarNaFila($user->id);
        if(!$user) {
            return response()->json(['message' => 'Erro ao registrar usuário'], 500);
        }
        return response()->json(['message' => 'Usuário registrado com sucesso', 'data' => $user, 'posicao' => $fila->posicao], 200);
    }
}
