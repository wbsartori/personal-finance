<?php

namespace App\Filament\Resources\FinCartaos\Schemas;

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
                ])->columnSpanFull()
            ]);
    }
}
