<?php

namespace App\Filament\Resources\FinEntradas\Tables;

use App\Enums\StatusEntrada;
use App\Enums\TipoLancamento;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

class FinEntradasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name')
                    ->sortable(),
                TextColumn::make('descricao')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('status')
                    ->alignCenter()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        StatusEntrada::PAGAMENTO_PREVISTO->value => StatusEntrada::PAGAMENTO_PREVISTO->toName(),
                        StatusEntrada::PAGAMENTO_ATRASADO->value => StatusEntrada::PAGAMENTO_ATRASADO->toName(),
                        StatusEntrada::PAGAMENTO_CONCLUIDO->value => StatusEntrada::PAGAMENTO_CONCLUIDO->toName(),
                    })
                    ->badge(fn ($state) => match ($state) {
                        StatusEntrada::PAGAMENTO_PREVISTO->value => 'success',
                        StatusEntrada::PAGAMENTO_ATRASADO->value => 'warning',
                        StatusEntrada::PAGAMENTO_CONCLUIDO->value => 'success',
                    })
                    ->searchable(),
                TextColumn::make('valor')->numeric()->money('BRL' )->sortable(),
                TextColumn::make('tipo_lancamento')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        TipoLancamento::AVISTA->value => TipoLancamento::AVISTA->toName(),
                        TipoLancamento::RECORRENTE->value => TipoLancamento::RECORRENTE->toName(),
                        TipoLancamento::PARCELADO->value => TipoLancamento::PARCELADO->toName(),
                    })
                    ->badge(fn ($state) => match ($state) {
                        TipoLancamento::AVISTA->value => 'success',
                        TipoLancamento::RECORRENTE->value => 'warning',
                        TipoLancamento::PARCELADO->value => 'success',
                    })
                    ->searchable(),
                TextColumn::make('numero_parcela')->searchable(),
                TextColumn::make('data_vencimento')->date('d/m/Y')->sortable(),
                TextColumn::make('data_pagamento')->date()->sortable(),

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
