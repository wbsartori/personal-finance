<?php

namespace App\Filament\Resources\FinEntradas\Pages;

use App\Filament\Resources\FinEntradas\FinEntradaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinEntradas extends ListRecords
{
    protected static string $resource = FinEntradaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nova Entrada'),
        ];
    }
}
