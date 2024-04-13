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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Entradas';
    protected static ?string $navigationGroup = 'Contas à receber';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                ->placeholder('Descrição da entrada'),
                Forms\Components\Select::make('type')
                    ->options([
                        'Bonificações' => 'Bonificações',
                        'Salário' => 'Salário',
                        'Outros' => 'Outros',
                    ])
                    ->label('Tipo'),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->placeholder('00,00')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefix('R$'),
                Forms\Components\DateTimePicker::make('entry_date')->label('Data da entrada'),
                Forms\Components\Select::make('people_id')
                    ->options(
                        People::query()->pluck('full_name', 'id')->toArray()
                    )
                    ->label('Quem recebeu ?')
                    ->hint('Pessoa que recebeu o valor.')
                    ->searchable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('entry_date')
                    ->label('Mês de entrada')
                    ->dateTime('M')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('people.full_name')
                    ->label('Quem recebeu?'),
                Tables\Columns\TextColumn::make('description')
                    ->label('O que recebeu?'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Quanto recebeu?'),
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
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntry::route('/create'),
            'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }
}
