<?php

namespace App\Filament\Resources\FinInvestimentos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FinInvestimentoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('users_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('data_investimento')
                    ->required(),
                TextInput::make('tipo_investimento')
                    ->default('A'),
                TextInput::make('descricao'),
                TextInput::make('fonte_investimento')
                    ->required(),
                TextInput::make('valor')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
