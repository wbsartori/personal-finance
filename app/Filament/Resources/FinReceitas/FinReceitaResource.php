<?php

namespace App\Filament\Resources\FinReceitas;

use App\Filament\Resources\FinReceitas\Pages\CreateFinReceita;
use App\Filament\Resources\FinReceitas\Pages\EditFinReceita;
use App\Filament\Resources\FinReceitas\Pages\ListFinReceitas;
use App\Filament\Resources\FinReceitas\Schemas\FinReceitaForm;
use App\Filament\Resources\FinReceitas\Tables\FinReceitasTable;
use App\Models\FinReceita;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FinReceitaResource extends Resource
{
    protected static ?string $model = FinReceita::class;

    protected static ?string $navigationLabel = 'Receitas';
    protected static string | UnitEnum | null $navigationGroup = 'Cadastros';
    protected static ?string $label = 'Receitas';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    public static function form(Schema $schema): Schema
    {
        return FinReceitaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinReceitasTable::configure($table);
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
            'index' => ListFinReceitas::route('/'),
            'create' => CreateFinReceita::route('/create'),
            'edit' => EditFinReceita::route('/{record}/edit'),
        ];
    }
}
