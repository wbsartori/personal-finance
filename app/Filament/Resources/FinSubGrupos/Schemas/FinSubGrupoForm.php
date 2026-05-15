<?php

namespace App\Filament\Resources\FinSubGrupos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinSubGrupoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('descricao')
                        ->required(),
                    Select::make('fin_grupos_id')
                        ->label('Grupo')
                        ->relationship('finGrupo', 'descricao')
                        ->options(\App\Models\FinGrupo::all()->pluck('descricao', 'id'))
                        ->searchable()
                        ->required(),
                ])->columnSpanFull()
            ]);
    }
}
