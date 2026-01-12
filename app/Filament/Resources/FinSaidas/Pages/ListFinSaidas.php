<?php

namespace App\Filament\Resources\FinSaidas\Pages;

use App\Filament\Resources\FinSaidas\FinSaidaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinSaidas extends ListRecords
{
    protected static string $resource = FinSaidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
