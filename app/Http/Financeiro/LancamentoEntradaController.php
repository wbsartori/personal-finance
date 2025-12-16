<?php

declare(strict_types=1);

namespace App\Http\Financeiro;

use App\Models\FinEntrada;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'users_id' => 'required|integer|exists:users,id',
            'observacoes' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|in:PIX,DEB,DIN,BOL,VAL',
            'tipo_lancamento' => 'required|string|max:255',
            'tipo_investimento' => 'nullable|string|in:A,R,D',
            'numero_parcela' => 'nullable|integer|min:1',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date|after_or_equal:data_vencimento',
            'data_investimento' => 'nullable|date',
            'cartao_credito' => 'nullable|integer',
            'status' => 'required|string|in:A,R,P',
        ]);

        $records = FinEntrada::create($validated);

        if($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message('cartões', MensagensRetorno::STORE_PADRAO)
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
            ->message('cartões', MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinEntrada $finEntrada, int $id): JsonResponse
    {
        $validated = $request->validate([
            'users_id' => 'required|integer|exists:users,id',
            'observacoes' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|in:PIX,DEB,DIN,BOL,VAL',
            'tipo_lancamento' => 'required|string|max:255',
            'tipo_investimento' => 'nullable|string|in:A,R,D',
            'numero_parcela' => 'nullable|integer|min:1',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date|after_or_equal:data_vencimento',
            'data_investimento' => 'nullable|date',
            'cartao_credito' => 'nullable|integer',
            'status' => 'required|string|in:A,R,P',
        ]);

        $records = $finEntrada->where('id', $id)->update($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message('cartões', MensagensRetorno::UPDATE_PADRAO)
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
