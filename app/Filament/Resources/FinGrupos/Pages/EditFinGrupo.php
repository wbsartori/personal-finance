<?php

namespace App\Filament\Resources\FinGrupos\Pages;

use App\Filament\Resources\FinGrupos\FinGrupoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinGrupo extends EditRecord
{
    protected static string $resource = FinGrupoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
