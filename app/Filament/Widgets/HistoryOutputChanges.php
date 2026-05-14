<?php

namespace App\Filament\Widgets;

use App\Models\HistoricoEntrada;
use App\Models\History;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;

class HistoryOutputChanges extends BaseWidget
{

    use InteractsWithTable;
    use InteractsWithPageFilters;
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Últimos gastos';


    public function table(Table $table): Table
    {
        return $table
            ->query(HistoricoEntrada::query()
                ->when($this->filterDate()['month'] ?? null, fn ($query, $month) => $query->whereMonth('historico_entradas.data_pagamento', '=', $month))
                ->when($this->filterDate()['year'] ?? null, fn ($query, $year) => $query->whereYear('historico_entradas.data_pagamento', '=', $year))
            )
            ->heading('Histórico de alterações')
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->label('Data da alteração')
                    ->date('d-m-Y', 'America/Sao_Paulo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Quem pagou?')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('descricao')
                    ->sortable()
                    ->label('O que pagou?')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descricao')
                    ->sortable()
                    ->label('O que pagou?')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->money('BRL', 0, 'pt_BR')
                    ->sortable()
                    ->label('Novo valor'),
            ]);
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
