<?php

declare(strict_types=1);

namespace App\Http\Financeiro\Controllers;

use App\Http\Financeiro\Requests\LancamentoSaidaRequest;
use App\Models\FinSaida;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class LancamentoSaidaController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $records = FinSaida::all()->toArray();
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
    public function store(LancamentoSaidaRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $records = FinSaida::create($validated);

            if ($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::STORE_PADRAO)
                    ->data([$records])
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
            $records = FinSaida::where('id', $id)->get()->toArray();
            if ($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::SHOW_PADRAO)
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
     * Update the specified resource in storage.
     */
    public function update(LancamentoSaidaRequest $request, FinSaida $FinSaida, int $id): JsonResponse
    {
        try {
            $validated = $request->validated();
            $records = $FinSaida->where('id', $id)->update($validated);

            if ($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::UPDATE_PADRAO)
                    ->data($FinSaida->where('id', $id)->get()->toArray())
                    ->response();
            }
            return MensagensRetorno::make()
                ->status(MensagensRetorno::ERRO)
                ->message(MensagensRetorno::ERRO_PADRAO)
                ->data($FinSaida->where('id', $id)->get()->toArray())
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
            $FinSaida = FinSaida::where('id', $id)->exists();
            if ($FinSaida) {
                $records = FinSaida::where('id', $id)->delete();

                if ($records) {
                    return MensagensRetorno::make()
                        ->status(MensagensRetorno::SUCESSO)
                        ->message(MensagensRetorno::DELETE_PADRAO)
                        ->response();
                }
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
