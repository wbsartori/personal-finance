<?php

namespace App\Filament\Resources\FinSaidas;

use App\Filament\Resources\FinSaidas\Pages\CreateFinSaida;
use App\Filament\Resources\FinSaidas\Pages\EditFinSaida;
use App\Filament\Resources\FinSaidas\Pages\ListFinSaidas;
use App\Filament\Resources\FinSaidas\Schemas\FinSaidaForm;
use App\Filament\Resources\FinSaidas\Tables\FinSaidasTable;
use App\Models\FinSaida;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FinSaidaResource extends Resource
{
    protected static ?string $model = FinSaida::class;

    protected static ?string $navigationLabel = 'Saídas';

    protected static string | UnitEnum | null $navigationGroup = 'Movimentações';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentArrowDown;

    public static function form(Schema $schema): Schema
    {
        return FinSaidaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinSaidasTable::configure($table);
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
            'index' => ListFinSaidas::route('/'),
            'create' => CreateFinSaida::route('/create'),
            'edit' => EditFinSaida::route('/{record}/edit'),
        ];
    }
}
