<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta = Venda::query();
        $vendas = $consulta->get();

        return ['message' => 'Listando vendas', 'data' => $vendas];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacao = $request->validate([
            'cafe_id' => 'required|integer',
            'quantidade' => 'required|integer',
            'total' => 'required|numeric',
        ]);

        $venda = new Venda();
        $venda->cafe_id = $validacao['cafe_id'];
        $venda->quantidade = $validacao['quantidade'];
        $venda->total = $validacao['total'];
        $venda->save();

        return response()->json(['message' => 'Venda criada com sucesso', 'data' => $venda], 201);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
