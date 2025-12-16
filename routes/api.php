<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::apiResource('cartoes', \App\Http\Financeiro\Controllers\FinCartaoController::class);
Route::apiResource('grupos', \App\Http\Financeiro\Controllers\FinGrupoController::class);
Route::apiResource('receitas', \App\Http\Financeiro\Controllers\FinReceitaController::class);
Route::apiResource('investimentos', \App\Http\Financeiro\Controllers\FinInvestimentoController::class);
