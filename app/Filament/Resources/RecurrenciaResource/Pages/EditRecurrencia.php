<?php

namespace App\Filament\Resources\RecurrenciaResource\Pages;

use App\Filament\Resources\RecurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecurrencia extends EditRecord
{
    protected static string $resource = RecurrenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
