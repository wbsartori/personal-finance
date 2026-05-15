<?php

namespace App\Filament\Resources\FinEntradas\Pages;

use App\Filament\Resources\FinEntradas\FinEntradaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinEntrada extends EditRecord
{
    protected static string $resource = FinEntradaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
