<?php

namespace App\Filament\Widgets;

use App\Models\Entry;
use App\Models\Output;
use App\Models\People;
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
        $currentMonth = $this->filterDate()['monthName'];
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
            Stat::make('Salário ' . $this->peopleName(1),
                'R$ ' . number_format($this->monthSalary(), 2, ',', '.')
            )
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->description('Salário mês de ' . $currentMonth)
                ->descriptionColor('success')
                ->color('success')
                ->chart([1,1,1,1,1]),
            Stat::make('Salário ' . $this->peopleName(2),
                'R$ ' . number_format($this->monthSalary(2), 2, ',', '.')
            )
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->description('Salário mês de ' . $currentMonth)
                ->descriptionColor('success')
                ->color('success')
                ->chart([1,1,1,1,1]),

        ];
    }

    public function peopleName(int $id)
    {
        return People::query()->find($id)->full_name;
    }

    public function monthSalary(int $people = 1): float
    {
        return Entry::query()
            ->when($this->filterDate()['month'] ?? null, fn ($query, $month) => $query->whereMonth('entry_date', '=', $month))
            ->when($this->filterDate()['year'] ?? null, fn ($query, $year) => $query->whereYear('entry_date', '=', $year))
            ->when('salario', fn ($query, $year) => $query->where('type', '=', 'salario'))
            ->when($people, fn ($query, $year) => $query->where('people_id', '=', $people))
            ->sum('value');
    }

    public function totalEntriesForCurrentMonth()
    {
        $entries = Entry::query()
            ->when($this->filterDate()['month'] ?? null, fn ($query, $month) => $query->whereMonth('entry_date', '=', $month))
            ->when($this->filterDate()['year'] ?? null, fn ($query, $year) => $query->whereYear('entry_date', '=', $year))
            ->sum('value');
        return [
            'color' => 'success',
            'value' => $entries,
        ];
    }

    public function totalOutputsForCurrentMonth()
    {
        $outputs = Output::query()
            ->when($this->filterDate()['month'] ?? null, fn ($query, $month) => $query->whereMonth('output_date', '=', $month))
            ->when($this->filterDate()['year'] ?? null, fn ($query, $year) => $query->whereYear('output_date', '=', $year))
            ->sum('value');
        return [
            'color' => 'danger',
            'value' => $outputs,
        ];
    }

    public function filterDate(): array
    {
        $date = $this->filters['date'] ?? null;
        Carbon::setLocale('pt_BR');
        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;
        $monthName = Carbon::parse($date)->monthName;
        return [
            'month' => $month,
            'year' => $year,
            'monthName' => $monthName
        ];
    }
}
