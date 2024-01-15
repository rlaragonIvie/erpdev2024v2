<?php

namespace App\Filament\Resources\ConcurrenciaResource\Pages;

use App\Filament\Resources\ConcurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewConcurrencia extends ViewRecord
{
    protected static string $resource = ConcurrenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
