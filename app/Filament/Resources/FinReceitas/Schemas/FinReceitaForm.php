<?php

namespace App\Filament\Resources\FinReceitas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class FinReceitaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->schema([
                    Hidden::make('users_id')->default(Auth::getUser()->id),
                    TextInput::make('users.name')
                        ->label('Usuário')
                        ->readonly()
                        ->formatStateUsing(function ($state) {
                        return Auth::getUser()->name;
                    })
                        ->required(),
                    TextInput::make('descricao')
                        ->required(),
                    TextInput::make('valor')
                        ->required(),
                    DatePicker::make('data_recebimento')
                        ->required(),
                ])->columnSpanFull()
            ]);
    }
}
