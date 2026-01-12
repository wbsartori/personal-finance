<?php

namespace App\Filament\Resources\FinReceitas\Pages;

use App\Filament\Resources\FinReceitas\FinReceitaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinReceita extends EditRecord
{
    protected static string $resource = FinReceitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
