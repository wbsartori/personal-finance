<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutputResource\Pages;
use App\Filament\Resources\OutputResource\RelationManagers;
use App\Filament\Resources\OutputResource\RelationManagers\InstallmentPaymentRelationManager;
use App\Models\Output;
use App\Models\People;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OutputResource extends Resource
{
    protected static ?string $model = Output::class;

    protected static ?string $navigationGroup = 'Financeiro';
    protected static ?string $navigationLabel = 'Contas à pagar';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label('ID')
                    ->readOnly()
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    }),
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->placeholder('Descrição da saída')
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    }),
                Forms\Components\Select::make('type')
                    ->options([
                        'alimentacao' => 'Alimentação',
                        'auxilio' => 'Auxilio',
                        'bonificacoes' => 'Bonificações',
                        'cartao_credito' => 'Cartão de crédito',
                        'casa' => 'Casa',
                        'ferias' => 'Férias',
                        'fixo' => 'Fixo',
                        'habitacao' => 'Habitação',
                        'outros' => 'Outros',
                        'lazer' => 'Lazer',
                        'salario' => 'Salário',
                        'saude' => 'Saúde',
                        'transporte' => 'Transporte',
                    ])
                    ->label('Tipo')
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    }),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->currencyMask('.', ',')
                    ->placeholder('00,00')
                    ->prefix('R$')
                    ->reactive()
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    }),
                Forms\Components\DateTimePicker::make('output_date')->label('Data da saída')
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    }),
                Forms\Components\Select::make('people_id')
                    ->options(
                        People::query()->pluck('full_name', 'id')->toArray()
                    )
                    ->label('Quem gastou ?')
                    ->hint('Pessoa que gastou o valor.')
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    })
                    ->searchable(),
                Forms\Components\Radio::make('status')
                    ->label('Status')
                    ->inline()
                    ->inlineLabel(false)
                    ->options([
                        'open' => 'Em aberto',
                        'paid' => 'Pago',
                        'in_installment' => 'Parcelado',
                    ])
                    ->disabled(function (Forms\Get $get){
                        return self::disabledFieldByStatus($get);
                    })
                    ->required()
                    ->default('open'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('output_date')
                    ->label('Mês de saída')
                    ->date('d-m-Y', 'America/Sao_Paulo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo de saída')
                    ->searchable(),
                Tables\Columns\TextColumn::make('people.full_name')
                    ->label('Quem pagou?')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('O que pagou?')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->currency()
                    ->money('BRL', 0, 'pt_BR')
                    ->label('Quanto pagou?'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        if ($state === 'open') {
                            return 'Em aberto';
                        } else if ($state === 'in_installment') {
                            return 'Parcelado';
                        }
                        return 'Pago';
                    })
                    ->color(function ($state) {
                        if ($state === 'open') {
                            return 'warning';
                        }else if ($state === 'in_installments') {
                            return 'gray';
                        }
                        return 'success';
                    })->searchable(),
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InstallmentPaymentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOutputs::route('/'),
            'create' => Pages\CreateOutput::route('/create'),
            'edit' => Pages\EditOutput::route('/{record}/edit'),
        ];
    }

    private static function disabledFieldByStatus(Forms\Get $get): bool
    {
        if(in_array($get('status'),  ['in_installment', 'paid'])) {
            return true;
        }
        return false;
    }

    private static function disabledRelation(Get $get): bool
    {
        return self::disabledFieldByStatus($get);
    }
}
