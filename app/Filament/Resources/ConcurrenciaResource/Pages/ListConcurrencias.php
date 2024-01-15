<?php

namespace App\Filament\Resources\ConcurrenciaResource\Pages;

use App\Filament\Resources\ConcurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConcurrencias extends ListRecords
{
    protected static string $resource = ConcurrenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
