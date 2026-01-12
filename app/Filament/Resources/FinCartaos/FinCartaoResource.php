<?php

namespace App\Filament\Resources\FinCartaos;

use App\Filament\Resources\FinCartaos\Pages\CreateFinCartao;
use App\Filament\Resources\FinCartaos\Pages\EditFinCartao;
use App\Filament\Resources\FinCartaos\Pages\ListFinCartaos;
use App\Filament\Resources\FinCartaos\Schemas\FinCartaoForm;
use App\Filament\Resources\FinCartaos\Tables\FinCartaosTable;
use App\Models\FinCartao;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FinCartaoResource extends Resource
{
    protected static ?string $model = FinCartao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CreditCard;

    protected static string | UnitEnum | null $navigationGroup = 'Cadastros';

    protected static ?string $navigationLabel = 'Cartões de créditos';

    protected static ?string $label = 'Cartões de crédito';

    public static function form(Schema $schema): Schema
    {
        return FinCartaoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinCartaosTable::configure($table);
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
            'index' => ListFinCartaos::route('/'),
            'create' => CreateFinCartao::route('/create'),
            'edit' => EditFinCartao::route('/{record}/edit'),
        ];
    }
}
