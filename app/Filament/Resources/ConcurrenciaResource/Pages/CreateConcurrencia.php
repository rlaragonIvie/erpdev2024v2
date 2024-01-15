<?php

namespace App\Filament\Resources\ConcurrenciaResource\Pages;

use App\Filament\Resources\ConcurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConcurrencia extends CreateRecord
{
    protected static string $resource = ConcurrenciaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }  
}
