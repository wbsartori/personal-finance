<?php

namespace App\Filament\Resources\FinInvestimentos\Actions\Investimento\Acoes;

use App\Models\FinInvestimento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class AcaoLancarInvestimento
{
    public function executar(array $data): string
    {
        try {
            DB::beginTransaction();
            $data['valor'] = $this->converterValorEmInteiro($data['valor']);
            FinInvestimento::create($data);
            DB::commit();
            return response()->json(['message' => 'Investimento lançado com sucesso']);
        } catch (Throwable $exception) {
            DB::rollBack();
            Log::error('Erro ao lançar investimento: ', [
                'message' => $exception->getMessage(),
            ]);
            return response()->json(['message' => 'Erro ao lançar investimento'], 500);
        }
    }

    private function converterValorEmInteiro(float $valor): int
    {
        return (int)str_replace(['.', ','], ['', ''], $valor);
    }
}
