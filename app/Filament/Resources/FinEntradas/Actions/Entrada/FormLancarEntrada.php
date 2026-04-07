<?php

namespace App\Filament\Resources\FinEntradas\Actions\Entrada;

use App\Enums\FormaPagamento;
use App\Enums\StatusEntrada;
use App\Enums\TipoLancamento;
use App\Models\FinGrupo;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;

class FormLancarEntrada
{
    public static function render()
    {
        return Action::make('lancar-entrada')->label('Lançar Entrada')
            ->modal()
            ->modalHeading('Lançar Nova Entrada')
            ->modalSubmitActionLabel('Lançar')
            ->closeModalByClickingAway(false)
            ->schema([
                Section::make()->schema([
                    Select::make('users_id')
                        ->label('Responsável da entrada')
                        ->options(User::all()->pluck('name', 'id'))->default(auth()->id()),
                    TextInput::make('descricao')->label('Descrição')->required(),
                    TextInput::make('valor')
                        ->required()
                        ->numeric()
                        ->default(0),
                    Select::make('forma_pagamento')->options(FormaPagamento::toOptions())->default(FormaPagamento::DEBITO->value),
                    Select::make('tipo_lancamento')->options(TipoLancamento::toOptions())->default(TipoLancamento::AVISTA->value),
                    Select::make('fin_grupos_id')->options(FinGrupo::all()->pluck('descricao', 'id'))->label('Grupo'),
                    TextInput::make('numero_parcela')->default('1')->numeric(),
                    DatePicker::make('data_vencimento')
                        ->suffixAction(
                            Action::make('limpar-data-pagamento')->action(function (Set $set) {
                                $set('data_pagamento', '');
                            })->label('')->icon(Heroicon::ArrowPath)
                        )
                        ->required(),
                    DatePicker::make('data_pagamento')
                        ->suffixAction(
                            Action::make('limpar-data-pagamento')->action(function (Set $set) {
                                $set('data_pagamento', '');
                            })->label('')->icon(Heroicon::ArrowPath)
                        ),
                    Radio::make('status')->options(StatusEntrada::toOptions())->default('PP')->inline()
                ])
            ])->action(function (array $data) {
                (new AcaoLancarEntrada())->executar($data);
            });
    }
}
