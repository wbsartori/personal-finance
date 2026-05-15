<?php

namespace App\Filament\Resources\FinSubGrupos\Pages;

use App\Filament\Resources\FinSubGrupos\FinSubGrupoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinSubGrupos extends ListRecords
{
    protected static string $resource = FinSubGrupoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
