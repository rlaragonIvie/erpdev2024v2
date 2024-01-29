<?php

namespace App\Filament\Resources\ContratoClienteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProyectoRelationManager extends RelationManager
{
    protected static string $relationship = 'proyecto';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigopr')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('codigopr')
            ->columns([
                Tables\Columns\TextColumn::make('codigopr')
                ->searchable()
                ->label('Código Proyecto'),     
                Tables\Columns\TextColumn::make('proyecto')
                ->searchable()
                ->label('Proyecto')
                ->wrap()
                ->grow(false),                           
                Tables\Columns\TextColumn::make('contratoCliente.contrato')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Contrato Cliente'),   
                Tables\Columns\TextColumn::make('importe')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->label('Importe'),
                Tables\Columns\TextColumn::make('fecha_alta')
                ->date()
                ->sortable()
                ->label('Alta')
                ->toggleable(isToggledHiddenByDefault:false),
                Tables\Columns\TextColumn::make('fecha_baja')
                ->date()
                ->sortable()
                ->label('Baja')
                ->toggleable(isToggledHiddenByDefault:false),
                Tables\Columns\TextColumn::make('fecha_inicio')
                ->date()
                ->sortable()
                ->label('Inicio')
                ->toggleable(isToggledHiddenByDefault:true),                       
                Tables\Columns\TextColumn::make('fecha_fin')
                ->date()
                ->sortable()
                ->label('Fin')
                ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('fecha_entrega')
                ->date()
                ->label('Entrega')
                ->toggleable(isToggledHiddenByDefault:true),   
                Tables\Columns\TextColumn::make('cerrado')
                ->date()
                ->toggleable(isToggledHiddenByDefault:true),                   
                Tables\Columns\TextColumn::make('coste_personal')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Coste de personal'),
                Tables\Columns\TextColumn::make('coste_directo')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Coste Directo'),
                Tables\Columns\TextColumn::make('coste_investigador')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Coste Investigadores'),
                Tables\Columns\TextColumn::make('subvencionada')
                    ->searchable()
                    ->label('Sub.')
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('repartible')
                    ->searchable()
                    ->label('Rep.')
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('tipologia.descripcion')
                    ->sortable()
                    ->searchable()
                    ->label('Tipo')
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('concurrencia.concurrencia_txt')
                    ->sortable()
                    ->label('Conc.')
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('recurrencia.recurrencia_txt')
                    ->sortable()
                    ->label('Recu.')
                    ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
