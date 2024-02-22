<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoResource\Pages;
use App\Filament\Resources\ProyectoResource\Pages\CreateProyecto;
use App\Filament\Resources\ProyectoResource\Pages\EditProyecto;
use App\Filament\Resources\ProyectoResource\Pages\ListProyectos;
use App\Filament\Resources\ProyectoResource\RelationManagers;
use App\Models\Proyecto;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProyectoResource extends Resource
{
    protected static ?string $model = Proyecto::class;
    protected static ?string $navigationGroup = 'Principal';
    protected static ?string $slug = 'proyectos';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigopr')
                    ->required()
                    ->maxLength(7),
                Forms\Components\TextInput::make('proyecto')
                    ->required()
                    ->maxLength(200),                
                Forms\Components\Select::make('codigo_contrato')
                    ->relationship('contratoCliente','contrato')
                    ->searchable()
                    ->preload()
                    ->label('Contrato Cliente'),     
                Forms\Components\TextInput::make('importe')
                    ->mask(RawJs::make('$money($input,'.',',',2)')),
                    //->stripCharacters('.')
                    //->numeric(),
                Forms\Components\Section::make('Fechas')
                    ->description('Hitos del proyecto')
                    ->schema([    
                        Forms\Components\DatePicker::make('fecha_alta')
                        ->native(true),
                        Forms\Components\DatePicker::make('fecha_baja')
                        ->native(true),                
                        Forms\Components\DatePicker::make('fecha_inicio')
                        ->native(true),
                        Forms\Components\DatePicker::make('fecha_fin')
                        ->native(true),
                        Forms\Components\DatePicker::make('fecha_entrega')
                        ->native(false),
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
                        ->relationship('tipologia_','descripcion')
                        ->required()
                        ->columnSpan(2),
                    Forms\Components\Select::make('concurrencia')
                        ->relationship('concurrencia_','concurrencia_txt')
                        ->columnSpan(2),
                    Forms\Components\Select::make('recurrencia')
                        ->relationship('recurrencia_','recurrencia_txt')
                        ->columnSpan(2),
                    Forms\Components\Select::make('codigo_area')
                        ->multiple()
                        ->relationship('areas','area')
                        ->preload()
                        ->columnSpan(3),                        
                    ])->columns(11),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigopr')
                ->searchable()
                ->label('Código Proyecto'),     
                TextColumn::make('proyecto')
                ->searchable()
                ->label('Proyecto')
                ->wrap()
                ->grow(false),                           
                TextColumn::make('contratoCliente.contrato')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Contrato Cliente'),   
                TextColumn::make('importe')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->label('Importe'),
                TextColumn::make('fecha_alta')
                ->date()
                ->sortable()
                ->label('Alta')
                ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('fecha_baja')
                ->date()
                ->sortable()
                ->label('Baja')
                ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('fecha_inicio')
                ->date()
                ->sortable()
                ->label('Inicio')
                ->toggleable(isToggledHiddenByDefault:true),                       
                TextColumn::make('fecha_fin')
                ->date()
                ->sortable()
                ->label('Fin')
                ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('fecha_entrega')
                ->date()
                ->label('Entrega')
                ->toggleable(isToggledHiddenByDefault:true),   
                TextColumn::make('cerrado')
                ->date()
                ->toggleable(isToggledHiddenByDefault:true),                   
                TextColumn::make('coste_personal')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Coste de personal'),
                TextColumn::make('coste_directo')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Coste Directo'),
                TextColumn::make('coste_investigador')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',                    
                )
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('Coste Investigadores'),
                TextColumn::make('subvencionada')
                    ->searchable()
                    ->label('Sub.')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('repartible')
                    ->searchable()
                    ->label('Rep.')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('tipologia_.descripcion')
                    ->sortable()
                    ->searchable()
                    ->label('Tipo')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('concurrencia_.concurrencia_txt')
                    ->sortable()
                    ->label('Conc.')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('recurrencia_.recurrencia_txt')
                    ->sortable()
                    ->label('Recu.')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('areas.area')
                    ->sortable()
                    ->label('Área')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Definición del proyecto')
                ->schema([
                    TextEntry::make('contratoClienteRS.contrato')
                    ->label('Contrato Cliente'),                
                    TextEntry::make('codigopr')
                    ->label('Código Proyecto'),
                    TextEntry::make('proyecto')
                    ->label('Proyecto'),
                    TextEntry::make('importe')
                    ->label('Importe')
                    ->numeric(
                        decimalPlaces: 2,
                        decimalSeparator: ',',
                        thousandsSeparator: '.',
                    ),                    
                ])->columns(3),
               Section::make('Hitos')
                    ->schema([                
                        TextEntry::make('fecha_alta')
                        ->date()
                        ->label('Alta'),
                        TextEntry::make('fecha_baja')
                        ->date()
                        ->label('Baja'),                                                    
                        TextEntry::make('fecha_inicio')
                        ->date()
                        ->label('Inicio'),                    
                        TextEntry::make('fecha_fin')
                        ->date()
                        ->label('Fin'),
                        TextEntry::make('fecha_entrega')
                        ->date()
                        ->label('Entrega')                    
                    ])->columns(3),
                Section::make('Estado y características')
                    ->schema([
                        TextEntry::make('subvencionada')
                            ->label('Subvencionada'),
                        TextEntry::make('repartible')
                            ->label('Repartible'),
                        TextEntry::make('tipologia_.descripcion')
                            ->label('Tipología'),
                        TextEntry::make('concurrencia_.concurrencia_txt')
                            ->label('Concurrencia'),
                        TextEntry::make('recurrencia_.recurrencia_txt')
                            ->label('Recurrencia'),
                        TextEntry::make('areas.area')
                            ->label('Área de conocimiento')                                               
                    ])->columns(3)
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
