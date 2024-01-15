<?php

namespace App\Filament\Resources\ConcurrenciaResource\Pages;

use App\Filament\Resources\ConcurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConcurrencia extends EditRecord
{
    protected static string $resource = ConcurrenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
