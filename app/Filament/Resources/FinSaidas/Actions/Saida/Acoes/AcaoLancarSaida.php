<?php

namespace App\Filament\Resources\FinSaidas\Actions\Saida\Acoes;

use App\Enums\TipoLancamento;
use App\Models\FinEntrada;
use App\Models\FinSaida;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class AcaoLancarSaida
{
    public function executar(array $data): string
    {
        try {
            DB::beginTransaction();
            $data['valor'] = $this->converterValorEmInteiro($data['valor']);
            $this->pagamentoRecorrente($data);
            $this->pagamentoParcelado($data);
            $this->pagamentoAvista($data);
            DB::commit();
            return response()->json(['message' => 'Saida lançada com sucesso']);
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

    private function pagamentoRecorrente(array $data): void
    {
        $dados = [];

        if(TipoLancamento::from($data['tipo_lancamento'])->value === TipoLancamento::RECORRENTE->value) {
            $numeroParcelas = (int)$data['numero_parcela'];
            $somaParcelas = 1;
            $data['numero_parcela'] = 1;
            $dados[] = $data;
            for ($i = 1; $i < $numeroParcelas; $i++) {
                $data['data_vencimento'] = date('Y-m-d', strtotime($data['data_vencimento'] . ' +1 month'));
                $somaParcelas = $somaParcelas + 1;
                $data['numero_parcela'] = $somaParcelas;
                $dados[] = $data;
            }
            foreach ($dados as $dado) {
                FinSaida::create($dado);
            }
        }
    }

    public function pagamentoParcelado(array $data): void
    {
        $dados = [];
        if(TipoLancamento::from($data['tipo_lancamento'])->value === TipoLancamento::PARCELADO->value) {
            $numeroParcelas = (int)$data['numero_parcela'];
            $somaParcelas = 1;
            $data['numero_parcela'] = 1;
            $data['valor'] = $data['valor'] / $numeroParcelas;
            $valorParcela = $data['valor'];
            $dados[] = $data;
            for ($i = 1; $i < $numeroParcelas; $i++) {
                $data['data_vencimento'] = date('Y-m-d', strtotime($data['data_vencimento'] . ' +1 month'));
                $somaParcelas = $somaParcelas + 1;
                $data['valor'] = $valorParcela;
                $data['numero_parcela'] = $somaParcelas;
                $dados[] = $data;
            }
            foreach ($dados as $dado) {
                FinSaida::create($dado);
            }
        }
    }

    public function pagamentoAvista(array $data): void
    {
        if(TipoLancamento::from($data['tipo_lancamento'])->value === TipoLancamento::AVISTA->value) {
            FinSaida::create($data);
        }
    }
}
