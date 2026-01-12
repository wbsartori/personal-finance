<?php

namespace App\Filament\Resources\FinSaidas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FinSaidaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('users_id')
                    ->required()
                    ->numeric(),
                TextInput::make('descricao'),
                TextInput::make('valor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('forma_pagamento')
                    ->required()
                    ->default('DEB'),
                TextInput::make('tipo_lancamento')
                    ->default('A'),
                TextInput::make('numero_parcela')
                    ->default('0'),
                TextInput::make('cartao_credito'),
                DatePicker::make('data_vencimento')
                    ->required(),
                DatePicker::make('data_pagamento'),
                TextInput::make('status')
                    ->required()
                    ->default('P'),
            ]);
    }
}
