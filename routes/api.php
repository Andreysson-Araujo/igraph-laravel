<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::apiResource('servicos', ServicoController::class);
Route::apiResource('unidades', UnidadeController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
