<?php

namespace App\Filament\Resources\OutputResource\RelationManagers;

use App\Services\InstallmentPayment\Impl\InstallmentPaymentService as InstallmentPaymentService;
use App\Models\Output;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;


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
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('installment-generate')
                    ->label('Gerar parcelas')
                    ->form([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\TextInput::make('output_id')->label('ID da saída')
                                ->readOnly()
                                ->formatStateUsing(function () {
                                    return Output::query()->get()[0]->id;
                                }),
                            Forms\Components\TextInput::make('installment_payment')->label('Valor')
                                ->readOnly()
                                ->formatStateUsing(function () {
                                    return Output::query()->get()[0]->value;
                                }),
                            Forms\Components\TextInput::make('installment')->label('Número de parcelas')->numeric(),
                        ]),
                    ])->action(function (array $data){
                        app(InstallmentPaymentService::class)->generate($data, $this->ownerRecord);
                    }),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
