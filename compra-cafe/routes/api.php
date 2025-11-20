<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\AuthController;

Route::prefix('cafes')->group(function () {
    Route::get('/', [CafeController::class, 'listar']);
    Route::post('/', [CafeController::class, 'criar']);
    Route::get('/{id}', [CafeController::class, 'buscar']);
    Route::put('/{id}', [CafeController::class, 'update']);
    Route::delete('/{id}', [CafeController::class, 'excluir']);
});

Route::post('/registro', function (Request $request) {
    $token = $request->user()->createToken('auth_token');
    return ['token' => $token->plainTextToken];
});