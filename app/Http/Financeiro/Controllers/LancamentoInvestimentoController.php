<?php

declare(strict_types=1);

namespace App\Http\Financeiro\Controllers;

use App\Http\Financeiro\Requests\LancamentoInvestimentoRequest;
use App\Models\FinInvestimento;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LancamentoInvestimentoController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = FinInvestimento::all()->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::INDEX_PADRAO)
            ->data($records)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LancamentoInvestimentoRequest $request): JsonResponse
    {
        $validated = $request->validated([
            'users_id' => 'required|integer|exists:users,id',
            'descricao' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|in:PIX,DEB,DIN,BOL,VAL',
            'tipo_lancamento' => 'required|string|max:255',
            'numero_parcela' => 'nullable|integer|min:1',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date|after_or_equal:data_vencimento',
            'cartao_credito' => 'nullable|integer',
            'status' => 'required|string|in:A,P,C',
        ]);

        $records = FinInvestimento::create($validated);

        if($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message( MensagensRetorno::STORE_PADRAO)
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
        $records = FinInvestimento::findOrFail($id)->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinInvestimento $FinInvestimento, int $id): JsonResponse
    {
        $validated = $request->validate([
            'users_id' => 'required|integer|exists:users,id',
            'descricao' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|in:PIX,DEB,DIN,BOL,VAL',
            'tipo_lancamento' => 'required|string|max:255',
            'numero_parcela' => 'nullable|integer|min:1',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date|after_or_equal:data_vencimento',
            'cartao_credito' => 'nullable|integer',
            'status' => 'required|string|in:A,P,C',
        ]);

        $records = $FinInvestimento->where('id', $id)->update($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message(MensagensRetorno::UPDATE_PADRAO)
                ->data($FinInvestimento->where('id', $id)->get()->toArray())
                ->response();
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->data($FinInvestimento->where('id', $id)->get()->toArray())
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $FinInvestimento = FinInvestimento::where('id', $id)->exists();
        if ($FinInvestimento) {
            $records = FinInvestimento::where('id', $id)->delete();

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
