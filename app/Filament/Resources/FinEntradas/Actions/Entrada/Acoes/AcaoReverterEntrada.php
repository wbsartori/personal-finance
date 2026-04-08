<?php

namespace App\Filament\Resources\FinEntradas\Actions\Entrada\Acoes;

use App\Enums\StatusEntrada;
use App\Models\FinEntrada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class AcaoReverterEntrada
{
    public function executar(array $data)
    {
        try {
            $entrada = FinEntrada::findOrFail($data['id']);
            if(StatusEntrada::from($entrada->status)->value !== StatusEntrada::PAGAMENTO_CONCLUIDO->value) {
                return response()->json(['status' => 'error', 'message' => 'Não é possível reverter um pagamento  que ainda não está concluído'], 400);
            }
            DB::beginTransaction();
                $data['status'] = StatusEntrada::PAGAMENTO_PREVISTO->value;
                if($data['data_vencimento'] < now() ) {
                    $data['status'] = StatusEntrada::PAGAMENTO_ATRASADO->value;
                }
                $data['data_pagamento'] = null;
                FinEntrada::where('id', $data['id'])->update($data);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Pagamento concluído com sucesso'], 200);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao reverter pagamento', ['exception' => $e]);
            return response()->json(['status' => 'error', 'message' => 'Erro ao concluir pagamento'], 500);
        }
    }
}
