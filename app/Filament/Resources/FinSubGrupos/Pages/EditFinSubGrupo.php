<?php

namespace App\Filament\Resources\FinSubGrupos\Pages;

use App\Filament\Resources\FinSubGrupos\FinSubGrupoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinSubGrupo extends EditRecord
{
    protected static string $resource = FinSubGrupoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
