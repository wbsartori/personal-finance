<?php

namespace App\Filament\Resources\FinEntradas\Actions\Entrada\Acoes;

use App\Enums\TipoLancamento;
use App\Models\FinEntrada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class AcaoLancarEntrada
{
    public function executar(array $data): string
    {
        try {
            DB::beginTransaction();
            $data['valor'] = $this->converterValorEmInteiro($data['valor']);
            $this->gerarRecorrencia($data);
            DB::commit();
            return response()->json(['message' => 'Entrada lançada com sucesso']);
        } catch (Throwable $exception) {
            DB::rollBack();
            Log::error('Erro ao lançar entrada: ', [
                'message' => $exception->getMessage(),
            ]);
            return response()->json(['message' => 'Erro ao lançar entrada'], 500);
        }
    }

    private function converterValorEmInteiro(float $valor): int
    {
        return (int)str_replace(['.', ','], ['', ''], $valor);
    }

    private function gerarRecorrencia(array $data): void
    {
        $dados = [];
        $numeroParcelas = (int)$data['numero_parcela'];
        $somaParcelas = 1;
        $data['numero_parcela'] = 1;
        $dados[] = $data;

        if(TipoLancamento::from($data['tipo_lancamento'])->value === TipoLancamento::RECORRENTE->value) {
            for ($i = 1; $i < $numeroParcelas; $i++) {
                $data['data_vencimento'] = date('Y-m-d', strtotime($data['data_vencimento'] . ' +1 month'));
                $somaParcelas = $somaParcelas + 1;
                $data['numero_parcela'] = $somaParcelas;
                $dados[] = $data;
            }
        }
        foreach ($dados as $dado) {
            FinEntrada::create($dado);
        }
    }
}
