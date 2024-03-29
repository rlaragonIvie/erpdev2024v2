<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratoClienteResource\Pages;
use App\Filament\Resources\ContratoClienteResource\RelationManagers;
use App\Filament\Resources\ContratoClienteResource\RelationManagers\ProyectoRelationManager;
use App\Models\ContratoCliente;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratoClienteResource extends Resource
{
    protected static ?string $model = ContratoCliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Contratos con clientes';
    protected static ?string $modelLabel = 'Contratos con clientes';

    protected static ?string $navigationGroup = 'Principal';
    protected static ?string $slug = 'contratos-con-clientes';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('contrato')
                ->maxLength(200)
                ->required()
                ->columnSpanFull(),
                TextInput::make('importe')
                ->numeric()
                ->required(),
                DatePicker::make('fecha_inicio'),
                DatePicker::make('fecha_fin'),
                TextInput::make('observaciones')
                ->maxLength(4000)
                ->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contrato')->searchable(),
                TextColumn::make('codigopr')->searchable()->sortable(),
                TextColumn::make('fecha_inicio')
                ->sortable()
                ->dateTime('d/m/Y'),
                TextColumn::make('fecha_fin')
                ->sortable()
                ->dateTime('d/m/Y'),
                TextColumn::make('observaciones')->toggleable(isToggledHiddenByDefault:true),
            ])
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
                Section::make('Contrato con cliente')
                ->schema([
                    TextEntry::make('contrato')
                    ->columnSpanFull(),
                    TextEntry::make('importe'),
                    TextEntry::make('fecha_inicio')
                        ->date()
                        ->label('Alta'),
                    TextEntry::make('fecha_fin')
                        ->date()
                        ->label('Alta'),
                    TextEntry::make('observaciones')
                    ->columnSpanFull(),
                ])->columns(3)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProyectoRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContratoClientes::route('/'),
            'create' => Pages\CreateContratoCliente::route('/create'),
            'edit' => Pages\EditContratoCliente::route('/{record}/edit'),
        ];
    }
}
