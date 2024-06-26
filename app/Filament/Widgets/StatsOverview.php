<?php

namespace App\Filament\Widgets;

use App\Models\Entry;
use App\Models\Output;
use Carbon\Carbon;
use Filament\Forms\Components\Builder;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $entry = $this->totalEntriesForCurrentMonth();
        $output = $this->totalOutputsForCurrentMonth();
        $total = $entry['value'] - $output['value'];
        $totalIcon = $total >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $totalColor = $total >= 0 ? 'success' : 'danger';
        $currentMonth = Carbon::now()->monthName;
        return [
            Stat::make(
                'Entradas',
                'R$ ' . number_format($entry['value'], 2, ',', '.')
            )->descriptionIcon('heroicon-m-arrow-trending-up')
                ->description('Ganhos mês de ' . $currentMonth)
                ->color($entry['color'])
            ->chart([1,1,1,1,1]),
            Stat::make(
                'Saídas',
                'R$ ' . number_format($output['value'], 2, ',', '.')
            )
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->description('Gastos mês de ' . $currentMonth)
                ->color($output['color'])
                ->chart([1,1,1,1,1]),
            Stat::make('Saldo',
                'R$ ' . number_format($total, 2, ',', '.')
            )
                ->descriptionIcon($totalIcon)
                ->description('Saldo mês de ' . $currentMonth)
                ->descriptionColor($totalColor)
                ->color($totalColor)
                ->chart([1,1,1,1,1]),
        ];
    }

    public function totalEntriesForCurrentMonth()
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $entries = Entry::query()
            ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->sum('value');
        return [
            'color' => 'success',
            'value' => $entries,
        ];
    }

    public function totalOutputsForCurrentMonth()
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $outputs = Output::query()
            ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->sum('value');
        return [
            'color' => 'danger',
            'value' => $outputs,
        ];
    }
}
