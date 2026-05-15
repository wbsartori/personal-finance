<?php

declare(strict_types=1);

namespace App\Importer;

use App\Enums\FormaPagamento;
use App\Enums\StatusPagamento;
use App\Enums\TipoLancamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OfxParser\Parser;

class AcaoImportar
{
    public function importar(array $data, $type = 'ofx'): void
    {
        try {
            $path = storage_path('app/' . $data['file']);
            $ofxParser = new Parser();
            $ofx = $ofxParser->loadFromFile($path);

            $dadosBancarios = [
                'agencia' => (string)$ofx->bankAccounts[0]->routingNumber[0],
                'conta' => (string)$ofx->bankAccounts[0]->accountNumber[0],
                'tipo' => (string)$ofx->bankAccounts[0]->accountType[0],
                'moeda' => (string)$ofx->bankAccounts[0]->statement->currency[0],
                'data_inicial' => $ofx->bankAccounts[0]->statement->startDate->format('Y-m-d'),
                'data_final' => $ofx->bankAccounts[0]->statement->endDate->format('Y-m-d'),
                'total_transacoes' => count($ofx->bankAccounts[0]->statement->transactions),
            ];

            $transactions = $ofx->bankAccounts[0]->statement->transactions;

            foreach ($transactions as $transaction) {
                DB::transaction(function () use ($transaction, $dadosBancarios) {
                    if($transaction->type === 'DEBIT') {
                        $this->importarSaida($transaction);
                    }
                    if($transaction->type === 'CREDIT') {
                        $this->importarEntrada($transaction);
                    }
                });
            }
        } catch (\Throwable $th) {
            Log::error('IMPORTACAO_VIA_ARQUIVO_' . strtoupper($type) . ': ' . $th->getMessage());
        }
    }

    private function calcularValor(float $amount): float|int
    {
        $novoValor = (int)round($amount * 100);
        return $novoValor > 0 ? $novoValor : $novoValor * -1;
    }

    private function importarEntrada($transaction): void
    {
        DB::table('fin_entradas')->insert([
            'users_id' => auth()->id(),
            'descricao' => $transaction->name,
            'valor' => $this->calcularValor($transaction->amount),
            'forma_pagamento' => FormaPagamento::DEBITO->value,
            'tipo_lancamento' => TipoLancamento::AVISTA->value,
            'numero_parcela' => 1,
            'data_vencimento' => $transaction->date->format('Y-m-d'),
            'data_pagamento' => $transaction->date->format('Y-m-d'),
            'status' => StatusPagamento::PAGAMENTO_CONCLUIDO->value,
        ]);
    }

    public function importarSaida($transaction): void
    {
        DB::table('fin_saidas')->insert([
            'users_id' => auth()->id(),
            'descricao' => $transaction->name,
            'valor' => $this->calcularValor($transaction->amount),
            'forma_pagamento' => FormaPagamento::DEBITO->value,
            'tipo_lancamento' => TipoLancamento::AVISTA->value,
            'numero_parcela' => 1,
            'data_vencimento' => $transaction->date->format('Y-m-d'),
            'data_pagamento' => $transaction->date->format('Y-m-d'),
            'status' => StatusPagamento::PAGAMENTO_CONCLUIDO->value,
        ]);
    }
}
