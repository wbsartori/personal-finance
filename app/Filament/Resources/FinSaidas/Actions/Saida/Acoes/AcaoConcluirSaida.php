<?php

namespace App\Filament\Resources\FinSaidas\Actions\Saida\Acoes;

use App\Enums\StatusPagamento;
use App\Models\FinSaida;
use Illuminate\Support\Facades\DB;

class AcaoConcluirSaida
{
    public function executar(array $data)
    {
        try {
            $entrada = FinSaida::findOrFail($data['id']);
            if(StatusPagamento::from($entrada->status)->value === StatusPagamento::PAGAMENTO_CONCLUIDO->value) {
                return response()->json(['status' => 'error', 'message' => 'Pagamento já concluído'], 400);
            }
            DB::beginTransaction();
            $data['status'] = StatusPagamento::PAGAMENTO_CONCLUIDO->value;
            $data['data_pagamento'] = now();
            FinSaida::where('id', $data['id'])->update($data);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Pagamento concluído com sucesso'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Erro ao concluir pagamento'], 500);
        }
    }
}
