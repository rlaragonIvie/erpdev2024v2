<?php

namespace App\Filament\Resources\RecurrenciaResource\Pages;

use App\Filament\Resources\RecurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRecurrencia extends ViewRecord
{
    protected static string $resource = RecurrenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
