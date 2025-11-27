<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\RegistroController as AuthController;

Route::prefix('cafes')->group(function () {
    Route::get('/', [CafeController::class, 'listar']);
    Route::post('/', [CafeController::class, 'criar']);
    Route::get('/{id}', [CafeController::class, 'buscar']);
    Route::put('/{id}', [CafeController::class, 'update']);
    Route::delete('/{id}', [CafeController::class, 'excluir']);
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/registro', [AuthController::class, 'registro']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuarios', [AuthController::class, 'buscar']);
    Route::put('/usuarios/{id}', [AuthController::class, 'atualizar']);
    Route::delete('/usuarios/{id}', [AuthController::class, 'excluir']);
});