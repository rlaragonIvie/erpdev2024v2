<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoResource\Pages;
use App\Filament\Resources\ProyectoResource\RelationManagers;
use App\Models\Proyecto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProyectoResource extends Resource
{
    protected static ?string $model = Proyecto::class;
    protected static ?string $navigationGroup = 'Principal';
    protected static ?string $slug = 'proyectos';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('codigo_contrato')
                    ->relationship('contratoCliente','contrato')
                    ->searchable()
                    ->preload(),                
                Forms\Components\TextInput::make('codigopr')
                    ->required()
                    ->maxLength(7),
                Forms\Components\TextInput::make('proyecto')
                    ->required()
                    ->maxLength(200),
                Forms\Components\TextInput::make('importe')
                    ->numeric(),
                Forms\Components\Section::make('Fechas')
                    ->description('Hitos del proyecto')
                    ->schema([                    
                        Forms\Components\DatePicker::make('fecha_inicio')
                            ->required()
                            ->native(true),
                        Forms\Components\DatePicker::make('fecha_fin')
                        ->native(true),
                // Forms\Components\TextInput::make('COSTE_PERSONAL')
                //     ->numeric(),
                // Forms\Components\TextInput::make('COSTE_DIRECTO')
                //     ->numeric(),
                // Forms\Components\TextInput::make('COSTE_INVESTIGADOR')
                //     ->numeric(),
                        Forms\Components\DatePicker::make('fecha_entrega')
                        ->native(false),
                // Forms\Components\DatePicker::make('CERRADO'),
                ])->columns(3),
                Forms\Components\Section::make('Características')
                    ->description('Caracteriza el proyecto')
                    ->schema([
                        Forms\Components\Select::make('subvencionada')
                        ->options([
                            'S' => 'Sí',
                            'N' => 'No',
                        ]),
                    Forms\Components\Select::make('repartible')
                        ->options([
                            'S' => 'Sí',
                            'N' => 'No',
                        ]),
                    Forms\Components\Select::make('tipologia')
                        ->relationship('tipologia','descripcion')
                        ->required()
                        ->columnSpan(3),
                    Forms\Components\Select::make('concurrencia')
                        ->relationship('concurrencia','concurrencia_txt')
                        ->columnSpan(3),
                    Forms\Components\Select::make('recurrencia')
                        ->relationship('recurrencia','recurrencia_txt')
                        ->columnSpan(3),
                    ])->columns(11),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contratoCliente.contrato')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Contrato'),                
                Tables\Columns\TextColumn::make('codigopr')
                ->searchable()
                ->label('Código Proyecto'),
                Tables\Columns\TextColumn::make('proyecto')
                ->searchable()
                ->label('Proyecto')
                ->grow(false),
                Tables\Columns\TextColumn::make('importe')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->label('Importe'),
                Tables\Columns\TextColumn::make('fecha_inicio')
                ->date()
                ->sortable()
                ->label('Inicio'),                    
                Tables\Columns\TextColumn::make('fecha_fin')
                ->date()
                ->sortable()
                ->label('Fin'),
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
                Tables\Columns\TextColumn::make('tipologia')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->label('Tipo')
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('concurrencia')
                    ->numeric()
                    ->sortable()
                    ->label('Conc.')
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('recurrencia')
                    ->numeric()
                    ->sortable()
                    ->label('Recu.')
                    ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->defaultSort('fecha_inicio','desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProyectos::route('/'),
            'create' => Pages\CreateProyecto::route('/create'),
            'edit' => Pages\EditProyecto::route('/{record}/edit'),
        ];
    }
}
