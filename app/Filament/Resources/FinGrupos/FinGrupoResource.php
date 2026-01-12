<?php

namespace App\Filament\Resources\FinGrupos;

use App\Filament\Resources\FinGrupos\Pages\CreateFinGrupo;
use App\Filament\Resources\FinGrupos\Pages\EditFinGrupo;
use App\Filament\Resources\FinGrupos\Pages\ListFinGrupos;
use App\Filament\Resources\FinGrupos\Schemas\FinGrupoForm;
use App\Filament\Resources\FinGrupos\Tables\FinGruposTable;
use App\Models\FinGrupo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FinGrupoResource extends Resource
{
    protected static ?string $model = FinGrupo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $label = 'Grupos';

    protected static ?string $navigationLabel = 'Grupos';

    protected static string | UnitEnum | null $navigationGroup = 'Cadastros';


    public static function form(Schema $schema): Schema
    {
        return FinGrupoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinGruposTable::configure($table);
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
            'index' => ListFinGrupos::route('/'),
            'create' => CreateFinGrupo::route('/create'),
            'edit' => EditFinGrupo::route('/{record}/edit'),
        ];
    }
}
