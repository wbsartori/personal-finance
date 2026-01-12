<?php

namespace App\Filament\Resources\FinCartaos\Pages;

use App\Filament\Resources\FinCartaos\FinCartaoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinCartao extends EditRecord
{
    protected static string $resource = FinCartaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
