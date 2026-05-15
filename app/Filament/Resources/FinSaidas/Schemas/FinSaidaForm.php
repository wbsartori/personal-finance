<?php

namespace App\Filament\Resources\FinSaidas\Schemas;

use App\Enums\FormaPagamento;
use App\Enums\StatusPagamento;
use App\Enums\TipoLancamento;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class FinSaidaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('users.name')->label('Responsável pela entrada'),
                    TextInput::make('descricao'),
                    TextInput::make('valor')
                        ->required()
                        ->mask(RawJs::make(<<<'JS'
                            $money($input, ',', '.', 2)
                            JS)
                        )
                        ->default(0),
                    Radio::make('forma_pagamento')
                        ->inline()
                        ->options(FormaPagamento::toOptions())
                        ->default('DEB'),
                    Radio::make('tipo_lancamento')
                        ->inline()
                        ->options(TipoLancamento::toOptions())
                        ->default('A'),
                    TextInput::make('numero_parcela')
                        ->label('Número da Parcela')
                        ->default('0'),
                    DatePicker::make('data_vencimento')
                        ->required(),
                    DatePicker::make('data_pagamento'),
                    Radio::make('status')
                        ->inline()
                        ->options(StatusPagamento::toOptions())
                        ->required()
                        ->default('P'),
                ])->columnSpanFull()
            ]);
    }
}
