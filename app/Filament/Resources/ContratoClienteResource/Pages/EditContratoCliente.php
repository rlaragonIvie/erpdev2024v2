<?php

namespace App\Filament\Resources\ContratoClienteResource\Pages;

use App\Filament\Resources\ContratoClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContratoCliente extends EditRecord
{
    protected static string $resource = ContratoClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
