<?php

namespace App\Filament\Resources\RecurrenciaResource\Pages;

use App\Filament\Resources\RecurrenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRecurrencia extends CreateRecord
{
    protected static string $resource = RecurrenciaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }  
}
