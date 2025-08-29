<?php

namespace App\Filament\Resources\OutputResource\Pages;

use App\Filament\Resources\OutputResource;
use App\Models\History;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutput extends EditRecord
{
    protected static string $resource = OutputResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        History::create([
            'user_id' => auth()->id(),
            'output_id' => $this->record->id,
            'people_id' => $this->record->people_id,
            'description' => $this->record->description,
            'type' => $this->record->type,
            'value' => $this->record->value,
            'output_date' => $this->record->output_date,
        ]);
    }
}
