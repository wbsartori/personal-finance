<?php

namespace App\Filament\Resources\OutputResource\RelationManagers;

use App\Models\InstallmentPayment;
use App\Services\InstallmentPayment\Impl\InstallmentPaymentService as InstallmentPaymentService;
use App\Models\Output;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;


class InstallmentPaymentRelationManager extends RelationManager
{
    protected static string $relationship = 'InstallmentPayment';

    public function form(Form $form): Form
    {
        return $form;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('description')->label('Descrição'),
                Tables\Columns\TextColumn::make('installment_number')->label('Parcela'),
                Tables\Columns\TextColumn::make('payment_value')->money('BRL')
                    ->label('Valor à pagar')
                    ->summarize(
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('BRL')
                            ->label('Total')
                    ),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Data de vencimento')
                    ->formatStateUsing(function ($state) {
                        $paymentDate = Carbon::parse($state);
                        return $paymentDate->format('d/m/Y');
                    }),
                Tables\Columns\TextColumn::make('payment_base_date')
                    ->label('Mês de referência')
                    ->formatStateUsing(function ($state) {
                        $paymentDate = Carbon::parse($state);
                        return $paymentDate->format('d/m/Y');
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        if ($state === 'open') {
                            return 'Em aberto';
                        }
                        return 'Pago';
                    })
                    ->color(function ($state) {
                        if ($state === 'open') {
                            return 'warning';
                        }
                        return 'success';
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('installment-generate')
                    ->label('Gerar parcelas')
                    ->form([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\TextInput::make('output_id')->label('ID da saída')
                                ->readOnly()
                                ->formatStateUsing(function () {
                                    return Output::query()->get()[0]->id;
                                }),
                            Forms\Components\TextInput::make('description')->label('Descrição')
                                ->formatStateUsing(function () {
                                    return Output::query()->get()[0]->description;
                                }),
                            Forms\Components\TextInput::make('installment_payment')->label('Valor')
                                ->formatStateUsing(function () {
                                    return Output::query()->get()[0]->value;
                                }),
                            Forms\Components\TextInput::make('installment')->label('Número de parcelas')->numeric(),
                        ]),
                    ])->action(function (array $data) {
                        app(InstallmentPaymentService::class)->generate($data, $this->ownerRecord);
                    }),
            ])->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->searchable();
    }
}
