<?php

namespace App\Filament\Resources\FinCartaos\Schemas;

use App\Enums\BandeiraCartao;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinCartaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('descricao')
                        ->label('Descrição')
                        ->required(),
                    Select::make('dia_vencimento')
                        ->label('Dia de vencimento')
                        ->options(function () {
                            $days = [];
                            for ($i = 1; $i <= 31; $i++) {
                                $days[$i] = $i;
                            }
                            return $days;
                        })
                        ->required(),
                    Select::make('bandeira')
                        ->options(BandeiraCartao::class)
                        ->label('Bandeira')
                        ->required(),
                    Select::make('user_id')
                        ->options(User::pluck('name', 'id'))
                        ->label('Responsável do cartão')
                        ->required(),
                    TextInput::make('limite_uso')
                        ->label('Limite de uso')
                        ->required(),
                    TextInput::make('limite_real')
                        ->label('Limite real')
                        ->required(),

                ])->columnSpanFull()
            ]);
    }
}
