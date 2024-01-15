<?php

namespace App\Filament\Resources\ContratoClienteResource\Pages;

use App\Filament\Resources\ContratoClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContratoClientes extends ListRecords
{
    protected static string $resource = ContratoClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
