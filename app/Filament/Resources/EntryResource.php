<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntryResource\Pages;
use App\Filament\Resources\EntryResource\RelationManagers;
use App\Models\Entry;
use App\Models\People;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntryResource extends Resource
{
    protected static ?string $model = Entry::class;
    protected static ?string $navigationGroup = 'Financeiro';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Contas à receber';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->placeholder('Descrição da entrada'),
                Forms\Components\Select::make('type')
                    ->options([
                        'bonificacoes' => 'Bonificações',
                        'salario' => 'Salário',
                        'outros' => 'Outros',
                    ])
                    ->label('Tipo'),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->currencyMask('.', ',')
                    ->placeholder('00,00')
                    ->prefix('R$'),
                Forms\Components\DateTimePicker::make('entry_date')->label('Data da entrada'),
                Forms\Components\Select::make('people_id')
                    ->options(
                        People::query()->pluck('full_name', 'id')->toArray()
                    )
                    ->label('Quem recebeu ?')
                    ->hint('Pessoa que recebeu o valor.')
                    ->searchable(),
                Forms\Components\Radio::make('status')
                    ->label('Status')
                    ->inline()
                    ->inlineLabel(false)
                    ->options([
                        'open' => 'Em aberto',
                        'received' => 'Recebido',
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
                Tables\Columns\TextColumn::make('entry_date')
                    ->label('Mês de entrada')
                    ->date('d-m-Y', 'America/Sao_Paulo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo de saída')
                    ->searchable(),
                Tables\Columns\TextColumn::make('people.full_name')
                    ->label('Quem recebeu?'),
                Tables\Columns\TextColumn::make('description')
                    ->label('O que recebeu?'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Quanto recebeu?')
                    ->currency()
                    ->money('BRL', 0, 'pt_BR'),
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
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        if ($state === 'open') {
                            return 'Em aberto';
                        }
                        return 'Recebido';
                    })
                    ->color(function ($state) {
                        if ($state === 'open') {
                            return 'warning';
                        }
                        return 'success';
                    })
            ])
            ->filters([
                Tables\Filters\Filter::make('entry_date')
                    ->label('Mês de entrada')
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
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntry::route('/create'),
            'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }

    private static function disabledFieldByStatus(Forms\Get $get): bool
    {
        if($get('status') === 'received') {
            return true;
        }
        return false;
    }
}
