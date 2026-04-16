<?php

namespace App\Filament\Resources\FinInvestimentos\Schemas;

use App\Enums\TipoInvestimento;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class FinInvestimentoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Select::make('users_id')
                        ->label('Responsável pelo investimento')
                        ->options(User::all()->pluck('name', 'id'))
                        ->default(auth()->id())
                        ->required(),
                    DatePicker::make('data_investimento')
                        ->required(),
                    Radio::make('tipo_investimento')
                        ->inline()
                        ->options(TipoInvestimento::toOptions())
                        ->default(TipoInvestimento::APORTE->value)
                        ->required(),
                    TextInput::make('descricao'),
                    TextInput::make('fonte_investimento')
                        ->required(),
                    TextInput::make('valor')
                        ->required()
                        ->mask(RawJs::make(<<<'JS'
                            $money($input, ',', '.', 2)
                            JS)
                        )
                        ->default(0),
                ])->columnSpanFull()
            ]);
    }
}
