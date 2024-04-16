<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EntryResource\Pages\CreateEntry;
use App\Filament\Resources\OutputResource;
use App\Models\Output;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestSpending extends BaseWidget
{

    use InteractsWithTable;
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Últimos gastos';


    public function table(Table $table): Table
    {
        return $table
            ->query(OutputResource::getEloquentQuery())
            ->heading('Últimos gastos')
            ->headerActions([
                Action::make('create')
                    ->url('outputs/create')
                    ->label('Cadastrar novo gasto')
            ])
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('output_date')
                    ->label('Mês de saída')
                    ->date('d-m-Y', 'America/Sao_Paulo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('people.full_name')
                    ->label('Quem pagou?')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->label('O que pagou?')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->currency()
                    ->money('BRL', 0, 'pt_BR')
                    ->sortable()
                    ->label('Quanto pagou?'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data de criação')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Data de atualização')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->url(fn(Output $record): string => route('filament.admin.resources.outputs.edit', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label(''),
            ]);
    }
}
