<?php

namespace App\Filament\Resources\FinSaidas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FinSaidasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('descricao')
                    ->searchable(),
                TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('forma_pagamento')
                    ->searchable(),
                TextColumn::make('tipo_lancamento')
                    ->searchable(),
                TextColumn::make('numero_parcela')
                    ->searchable(),
                TextColumn::make('cartao_credito')
                    ->searchable(),
                TextColumn::make('data_vencimento')
                    ->date()
                    ->sortable(),
                TextColumn::make('data_pagamento')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
