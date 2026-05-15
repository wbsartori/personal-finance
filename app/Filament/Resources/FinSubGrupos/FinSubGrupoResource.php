<?php

namespace App\Filament\Resources\FinSubGrupos;

use App\Filament\Resources\FinSubGrupos\Pages\CreateFinSubGrupo;
use App\Filament\Resources\FinSubGrupos\Pages\EditFinSubGrupo;
use App\Filament\Resources\FinSubGrupos\Pages\ListFinSubGrupos;
use App\Filament\Resources\FinSubGrupos\Schemas\FinSubGrupoForm;
use App\Filament\Resources\FinSubGrupos\Tables\FinSubGruposTable;
use App\Models\FinSubGrupo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FinSubGrupoResource extends Resource
{
    protected static ?string $model = FinSubGrupo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $label = 'Sub Grupos';

    protected static ?string $navigationLabel = 'Sub Grupos';

    protected static string|null|\UnitEnum $navigationGroup = 'Cadastros';

    public static function form(Schema $schema): Schema
    {
        return FinSubGrupoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinSubGruposTable::configure($table);
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
            'index' => ListFinSubGrupos::route('/'),
            'create' => CreateFinSubGrupo::route('/create'),
            'edit' => EditFinSubGrupo::route('/{record}/edit'),
        ];
    }
}
