<?php

namespace App\Filament\Resources\FinInvestimentos;

use App\Filament\Resources\FinInvestimentos\Pages\CreateFinInvestimento;
use App\Filament\Resources\FinInvestimentos\Pages\EditFinInvestimento;
use App\Filament\Resources\FinInvestimentos\Pages\ListFinInvestimentos;
use App\Filament\Resources\FinInvestimentos\Schemas\FinInvestimentoForm;
use App\Filament\Resources\FinInvestimentos\Tables\FinInvestimentosTable;
use App\Models\FinInvestimento;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FinInvestimentoResource extends Resource
{
    protected static ?string $model = FinInvestimento::class;

    protected static ?string $navigationLabel = 'Investimentos';

    protected static string | UnitEnum | null $navigationGroup = 'Movimentações';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;

    public static function form(Schema $schema): Schema
    {
        return FinInvestimentoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinInvestimentosTable::configure($table);
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
            'index' => ListFinInvestimentos::route('/'),
            'create' => CreateFinInvestimento::route('/create'),
            'edit' => EditFinInvestimento::route('/{record}/edit'),
        ];
    }
}
