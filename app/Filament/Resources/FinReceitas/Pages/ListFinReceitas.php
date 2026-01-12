<?php

namespace App\Filament\Resources\FinReceitas\Pages;

use App\Filament\Resources\FinReceitas\FinReceitaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinReceitas extends ListRecords
{
    protected static string $resource = FinReceitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nova Receita'),
        ];
    }
}
