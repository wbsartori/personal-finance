<?php

namespace App\Filament\Resources\FinInvestimentos\Actions\Investimento;

use App\Enums\TipoInvestimento;
use App\Filament\Resources\FinInvestimentos\Actions\Investimento\Acoes\AcaoLancarInvestimento;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;

class FormLancarInvestimento
{
    public static function render()
    {
        return Action::make('lancar-investimento')->label('Lançar Investimento')
            ->modal()
            ->modalHeading('Lançar Novo Investimento')
            ->modalSubmitActionLabel('Lançar')
            ->closeModalByClickingAway(false)
            ->schema([
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
                    TextInput::make('descricao')->label('Descrição'),
                    TextInput::make('fonte_investimento')
                        ->label('Fonte do Investimento')
                        ->required(),
                    TextInput::make('valor')
                        ->required()
                        ->numeric()
                        ->default(0),
                ])
            ])->action(function (array $data) {
                (new AcaoLancarInvestimento())->executar($data);
            });
    }
}
