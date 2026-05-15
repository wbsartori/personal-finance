<?php

declare(strict_types=1);

namespace App\Http\Financeiro\Controllers;

use App\Http\Financeiro\Requests\LancamentoEntradaRequest;
use App\Models\FinEntrada;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class LancamentoEntradaController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $records = FinEntrada::all()->toArray();
            if($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::INDEX_PADRAO)
                    ->data($records)
                    ->response();
            }
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message(MensagensRetorno::NENHUM_REGISTRO_ENCONTRADO)
                ->data($records)
                ->response();
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_INTERNO_500)
                ->response(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LancamentoEntradaRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $records = FinEntrada::create($validated);

            if($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::STORE_PADRAO)
                    ->data($records)
                    ->response();
            }
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_PADRAO)
                ->data($records->where('id', $request->id)->get()->toArray())
                ->response();
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_INTERNO_500)
                ->response(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $records = FinEntrada::where('id', $id)->get()->toArray();
            if($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::SHOW_PADRAO)
                    ->data([$records])
                    ->response();
            }
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message(MensagensRetorno::NENHUM_REGISTRO_ENCONTRADO)
                ->response();
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_INTERNO_500)
                ->response(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LancamentoEntradaRequest $request, FinEntrada $finEntrada, int $id): JsonResponse
    {
        try {
            $validated = $request->validated();
            $records = $finEntrada->where('id', $id)->update($validated);

            if ($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::UPDATE_PADRAO)
                    ->data($finEntrada->where('id', $id)->get()->toArray())
                    ->response();
            }
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_PADRAO)
                ->data($finEntrada->where('id', $id)->get()->toArray())
                ->response();
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_INTERNO_500)
                ->response(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            if (!FinEntrada::where('id', $id)->exists()) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::ERRO)
                    ->message("O id da entrada {$id} não foi encontrado")
                    ->response();
            }

            $records = FinEntrada::where('id', $id)->delete();

            if ($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::DELETE_PADRAO)
                    ->response();
            }
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_PADRAO)
                ->response();
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_INTERNO_500)
                ->response(500);
        }
    }
}
