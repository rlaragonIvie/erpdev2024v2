<?php

namespace App\Filament\Resources\ProyectoResource\Pages;

use App\Filament\Resources\ProyectoResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListProyectos extends ListRecords
{
    protected static string $resource = ProyectoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active projects' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('fecha_baja')
            ->where('codigopr','like','P%')),
            'closed projects' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('fecha_baja')
            ->where('codigopr','like','P%')),
        ];
    }    
}
