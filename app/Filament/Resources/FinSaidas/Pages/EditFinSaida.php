<?php

namespace App\Filament\Resources\FinSaidas\Pages;

use App\Filament\Resources\FinSaidas\FinSaidaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinSaida extends EditRecord
{
    protected static string $resource = FinSaidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
