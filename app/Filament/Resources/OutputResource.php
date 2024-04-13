<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutputResource\Pages;
use App\Filament\Resources\OutputResource\RelationManagers;
use App\Models\Output;
use App\Models\People;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutputResource extends Resource
{
    protected static ?string $model = Output::class;
    protected static ?string $navigationLabel = 'Saídas';
    protected static ?string $navigationGroup = 'Contas à pagar';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->placeholder('Descrição da saída'),
                Forms\Components\Select::make('type')
                    ->options([
                        'Alimentação' => 'Alimentação',
                        'Auxilio' => 'Auxilio',
                        'Bonificações' => 'Bonificações',
                        'Cartão de crédito' => 'Cartão de crédito',
                        'Casa' => 'Casa',
                        'Férias' => 'Férias',
                        'Fixo' => 'Fixo',
                        'Habitação' => 'Habitação',
                        'Outros' => 'Outros',
                        'Lazer' => 'Lazer',
                        'Salário' => 'Salário',
                        'Saúde' => 'Saúde',
                        'Transporte' => 'Transporte',
                    ])
                    ->label('Tipo'),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->placeholder('00,00')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefix('R$'),
                Forms\Components\DateTimePicker::make('output_date')->label('Data da saída'),
                Forms\Components\Select::make('people_id')
                    ->options(
                        People::query()->pluck('full_name', 'id')->toArray()
                    )
                    ->label('Quem gastou ?')
                    ->hint('Pessoa que gastou o valor.')
                    ->searchable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('output_date')
                    ->label('Mês de saída')
                    ->dateTime('M')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('people.full_name')
                    ->label('Quem pagou?'),
                Tables\Columns\TextColumn::make('description')
                    ->label('O que pagou?'),
                Tables\Columns\TextColumn::make('value')
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
            //
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
}
