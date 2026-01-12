<?php

namespace App\Filament\Resources\FinEntradas;

use App\Filament\Resources\FinEntradas\Pages\CreateFinEntrada;
use App\Filament\Resources\FinEntradas\Pages\EditFinEntrada;
use App\Filament\Resources\FinEntradas\Pages\ListFinEntradas;
use App\Filament\Resources\FinEntradas\Schemas\FinEntradaForm;
use App\Filament\Resources\FinEntradas\Tables\FinEntradasTable;
use App\Models\FinEntrada;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FinEntradaResource extends Resource
{
    protected static ?string $model = FinEntrada::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCurrencyDollar;

    protected static ?string $navigationLabel = 'Entradas';
    protected static string|null|\UnitEnum $navigationGroup = 'Movimentações';

    public static function form(Schema $schema): Schema
    {
        return FinEntradaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinEntradasTable::configure($table);
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
            'index' => ListFinEntradas::route('/'),
            'create' => CreateFinEntrada::route('/create'),
            'edit' => EditFinEntrada::route('/{record}/edit'),
        ];
    }
}
