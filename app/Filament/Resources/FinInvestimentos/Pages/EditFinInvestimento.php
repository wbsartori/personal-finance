<?php

namespace App\Filament\Resources\FinInvestimentos\Pages;

use App\Filament\Resources\FinInvestimentos\FinInvestimentoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinInvestimento extends EditRecord
{
    protected static string $resource = FinInvestimentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
