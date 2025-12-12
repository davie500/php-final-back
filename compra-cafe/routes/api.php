<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\RegistroController;

Route::prefix('cafes')->group(function () {
    Route::get('/', [CafeController::class, 'listar']);
    Route::get('/{id}', [CafeController::class, 'buscar']);
    Route::post('/', [CafeController::class, 'criar']);
    Route::delete('/{id}', [CafeController::class, 'excluir']);
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/registro', [RegistroController::class, 'registro']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuarios', [RegistroController::class, 'buscar']);
    Route::put('/usuarios/{id}', [RegistroController::class, 'atualizar']);
    Route::delete('/usuarios/{id}', [RegistroController::class, 'excluir']);
});