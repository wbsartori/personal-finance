<?php

namespace App\Filament\Resources\FinInvestimentos\Pages;

use App\Filament\Resources\FinInvestimentos\FinInvestimentoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinInvestimentos extends ListRecords
{
    protected static string $resource = FinInvestimentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
