<?php

declare(strict_types=1);

namespace App\Http\Financeiro\Controllers;

use App\Http\Financeiro\Requests\LancamentoEntradaRequest;
use App\Models\FinEntrada;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;

class LancamentoEntradaController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = FinEntrada::all()->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::INDEX_PADRAO)
            ->data($records)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LancamentoEntradaRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $records = FinEntrada::create($validated);

        if($records) {
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
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $records = FinEntrada::findOrFail($id)->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LancamentoEntradaRequest $request, FinEntrada $finEntrada, int $id): JsonResponse
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $finEntrada = FinEntrada::where('id', $id)->exists();
        if ($finEntrada) {
            $records = FinEntrada::where('id', $id)->delete();

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
    }
}
