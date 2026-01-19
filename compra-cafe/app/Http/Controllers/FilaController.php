<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fila;
use App\Models\User;

class FilaController extends Controller
{
    public function listar()
    {
        $fila = Fila::with('usuario')->orderBy('posicao')->get();
        return response()->json(['message' => 'Fila atual', 'data' => $fila], 200);
    }
}
