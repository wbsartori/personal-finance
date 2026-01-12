<?php

namespace App\Filament\Resources\FinCartaos\Pages;

use App\Filament\Resources\FinCartaos\FinCartaoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinCartaos extends ListRecords
{
    protected static string $resource = FinCartaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Novo Cartão'),
        ];
    }
}
