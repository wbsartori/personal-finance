<?php

namespace App\Filament\Resources\FinInvestimentos\Tables;

use App\Enums\TipoInvestimento;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FinInvestimentosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name')
                    ->label('Responsável')
                    ->sortable(),
                TextColumn::make('data_investimento')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('tipo_investimento')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        TipoInvestimento::APORTE->value => TipoInvestimento::APORTE->toName(),
                        TipoInvestimento::RETIRADA->value => TipoInvestimento::RETIRADA->toName(),
                        TipoInvestimento::DIVIDENDO->value => TipoInvestimento::DIVIDENDO->toName(),
                    })
                    ->badge(fn ($state) => match ($state) {
                        TipoInvestimento::APORTE->value => 'success',
                        TipoInvestimento::RETIRADA->value => 'danger',
                        TipoInvestimento::DIVIDENDO->value => 'info',
                    })
                    ->color(fn ($state) => match ($state) {
                        TipoInvestimento::APORTE->value => 'success',
                        TipoInvestimento::RETIRADA->value => 'danger',
                        TipoInvestimento::DIVIDENDO->value => 'info',
                    })
                    ->searchable(),
                TextColumn::make('descricao')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('fonte_investimento')
                    ->label('Fonte')
                    ->searchable(),
                TextColumn::make('valor')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label(''),
                DeleteAction::make()->label(''),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
