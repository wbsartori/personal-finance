<?php

namespace App\Filament\Resources\FinSaidas\Tables;

use App\Enums\StatusPagamento;
use App\Enums\TipoLancamento;
use App\Filament\Resources\FinSaidas\Actions\Saida\Acoes\AcaoConcluirSaida;
use App\Filament\Resources\FinSaidas\Actions\Saida\Acoes\AcaoReverterSaida;
use App\Models\FinSaida;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class FinSaidasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name')
                    ->sortable(),
                TextInputColumn::make('descricao')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('status')
                    ->alignCenter()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        StatusPagamento::PAGAMENTO_PREVISTO->value => StatusPagamento::PAGAMENTO_PREVISTO->toName(),
                        StatusPagamento::PAGAMENTO_ATRASADO->value => StatusPagamento::PAGAMENTO_ATRASADO->toName(),
                        StatusPagamento::PAGAMENTO_CONCLUIDO->value => StatusPagamento::PAGAMENTO_CONCLUIDO->toName(),
                    })
                    ->badge(fn ($state) => match ($state) {
                        StatusPagamento::PAGAMENTO_PREVISTO->value => 'info',
                        StatusPagamento::PAGAMENTO_ATRASADO->value => 'danger',
                        StatusPagamento::PAGAMENTO_CONCLUIDO->value => 'success',
                    })
                    ->color(fn ($state) => match ($state) {
                        StatusPagamento::PAGAMENTO_PREVISTO->value => 'info',
                        StatusPagamento::PAGAMENTO_ATRASADO->value => 'danger',
                        StatusPagamento::PAGAMENTO_CONCLUIDO->value => 'success',
                    })
                    ->searchable(),
                TextInputColumn::make('valor')
                    ->prefix('R$ ')
                    ->sortable()
                    ->type('number')
                    ->inputMode('decimal'),
                TextColumn::make('tipo_lancamento')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        TipoLancamento::AVISTA->value => TipoLancamento::AVISTA->toName(),
                        TipoLancamento::RECORRENTE->value => TipoLancamento::RECORRENTE->toName(),
                        TipoLancamento::PARCELADO->value => TipoLancamento::PARCELADO->toName(),
                    })
                    ->badge(fn ($state) => match ($state) {
                        TipoLancamento::AVISTA->value => 'info',
                        TipoLancamento::RECORRENTE->value => 'danger',
                        TipoLancamento::PARCELADO->value => 'success',
                    })
                    ->searchable(),
                TextColumn::make('numero_parcela')
                    ->searchable(),
                TextColumn::make('data_vencimento')->date('d/m/Y')->sortable(),
                TextColumn::make('data_pagamento')->date('d/m/Y')->sortable(),
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
                Action::make('finalizar-entrada')
                    ->label('')
                    ->icon('heroicon-o-check')
                    ->action(function (FinSaida $finSaida): void {
                        $saida = (new AcaoConcluirSaida())
                            ->executar($finSaida->toArray());
                        $mensagemRetorno = $saida->getData(true);
                        if($mensagemRetorno['status'] == 'success') {
                            Notification::make()
                                ->success()
                                ->body($mensagemRetorno['message'])
                                ->send();
                            return;
                        }
                        Notification::make()
                            ->danger()
                            ->body($mensagemRetorno['message'])
                            ->send();
                        return;
                    })->requiresConfirmation()->modalHeading('Finalizar Saída'),
                Action::make('reverter-saida')
                    ->label('')
                    ->color('danger')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->action(function (FinSaida $finSaida): void {
                        $saida = (new AcaoReverterSaida())
                            ->executar($finSaida->toArray());
                        $mensagemRetorno = $saida->getData(true);
                        if($mensagemRetorno['status'] == 'success') {
                            Notification::make()
                                ->success()
                                ->body($mensagemRetorno['message'])
                                ->send();
                            return;
                        }
                        Notification::make()
                            ->danger()
                            ->body($mensagemRetorno['message'])
                            ->send();
                        return;
                    })->requiresConfirmation()->modalHeading('Reverter Saida'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
