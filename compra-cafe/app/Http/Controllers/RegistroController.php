<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function buscar(Request $request)
    {
        $auth = $request->user();

        if (!$auth || !$auth->admin) {
            return response()->json(['message' => 'Ação permitida apenas para administradores'], 403);
        }

        $usuarios = User::where('admin', false)->get();
        
        return response()->json(['message' => 'Listando usuários', 'data' => $usuarios], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
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

        if(!$user) {
            return response()->json(['message' => 'Erro ao registrar usuário'], 500);
        }

        return response()->json(['message' => 'Usuário registrado com sucesso', 'data' => $user], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function atualizar(Request $request, string $id)
    {
        $auth = $request->user();

        if (!$auth || !$auth->admin) {
            return response()->json(['message' => 'Ação permitida apenas para administradores'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if ($user->admin) {
            return response()->json(['message' => 'Não é permitido editar usuário administrador'], 403);
        }

        $validated = $request->validate([
            'nome' => 'sometimes|string',
            'email' => 'sometimes|email|unique:usuarios,email,'.$id,
            'senha_hash' => 'sometimes|string|min:8',
        ]);

        if (isset($validated['nome'])) {
            $user->nome = $validated['nome'];
        }
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (isset($validated['senha_hash'])) {
            $user->senha_hash = Hash::make($validated['senha_hash']);
        }

        $user->save();

        return response()->json(['message' => 'Usuário atualizado com sucesso', 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function excluir(string $id)
    {
        $auth = auth('sanctum')->user();

        if (!$auth || !$auth->admin) {
            return response()->json(['message' => 'Ação permitida apenas para administradores'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if ($user->admin) {
            return response()->json(['message' => 'Não é permitido excluir usuário administrador'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso'], 200);
    }
}
