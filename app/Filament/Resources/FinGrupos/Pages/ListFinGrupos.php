<?php

namespace App\Filament\Resources\FinGrupos\Pages;

use App\Filament\Resources\FinGrupos\FinGrupoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinGrupos extends ListRecords
{
    protected static string $resource = FinGrupoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Novo Grupo'),
        ];
    }
}
