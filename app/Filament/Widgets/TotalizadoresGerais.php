<?php

namespace App\Filament\Widgets;

use App\Models\FinEntrada;
use App\Models\FinInvestimento;
use App\Models\FinSaida;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalizadoresGerais extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalEntradas = 0.00;
        $entradas = FinEntrada::all();
        foreach ($entradas as $entrada) {
            $totalEntradas += $entrada->valor;
        }

        $totalSaidas = FinSaida::sum('valor');
        $totalInvestimentos = FinInvestimento::sum('valor');
        return [
            Stat::make('Total de entradas', 'R$ ' . number_format($totalEntradas / 100, 2, ',', '.')),
            Stat::make('Total de saídas', 'R$ ' . number_format($totalSaidas / 100, 2, ',', '.')),
            Stat::make('Total de investimentos', 'R$ ' . number_format($totalInvestimentos / 100, 2, ',', '.')),
        ];
    }
}
