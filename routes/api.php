<?php

use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::apiResource('cartoes', \App\Http\Cadastros\Controllers\FinCartaoController::class);
Route::apiResource('grupos', \App\Http\Cadastros\Controllers\FinGrupoController::class);
Route::apiResource('receitas', \App\Http\Cadastros\Controllers\FinReceitaController::class);
Route::apiResource('investimentos', \App\Http\Cadastros\Controllers\FinInvestimentoController::class);
Route::apiResource('lancamentos/entradas', \App\Http\Financeiro\Controllers\LancamentoEntradaController::class);
Route::apiResource('lancamentos/saidas', \App\Http\Financeiro\Controllers\LancamentoSaidaController::class);
Route::apiResource('lancamentos/investimentos', \App\Http\Financeiro\Controllers\LancamentoInvestimentoController::class);
