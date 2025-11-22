<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Http\Requests\CafeRequest;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule as ValidationRule;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listar()
    {
        $consulta = Cafe::query();
        $cafes = $consulta->get();

        return ['message' => 'Listando cafés', 'data' => $cafes];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function criar(CafeRequest $request)
    {
        $validacao = $request->all();

        $cafe = new Cafe;
        $cafe->nome = $validacao['nome'];
        $cafe->origem = $validacao['origem'];
        $cafe->marca = $validacao['marca'];
        $cafe->preco = $validacao['preco'];
        $cafe->save();
        
        return ['message' => 'Café criado com sucesso', 'data' => $cafe];
    }

    /**
     * Display the specified resource.
     */
    public function buscar(string $id)
    {
        $consulta = Cafe::query();
        $consulta->where('id', $id);

        $cafe = Cafe::find($id);
        return ['message' => 'Detalhes do café', 'data' => $cafe];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function excluir(string $id)
    {
        $cafe = Cafe::find($id);
        
        $cafe->delete();
        return ['message' => 'Deletando ID '. $id .' café'];
    }
}
