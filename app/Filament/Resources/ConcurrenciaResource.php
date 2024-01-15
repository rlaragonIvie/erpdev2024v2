<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConcurrenciaResource\Pages;
use App\Filament\Resources\ConcurrenciaResource\RelationManagers;
use App\Models\Concurrencia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConcurrenciaResource extends Resource
{
    protected static ?string $model = Concurrencia::class;
    protected static ?string $navigationLabel = 'Tipo de concurrencia';
    protected static ?string $modelLabel = 'Tipo de concurrencia ';

    protected static ?string $navigationGroup = 'Características';
    protected static ?string $slug = 'tipo-de-concurrencia';
    protected static ?int $navigationSort = 1;    

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('concurrencia_txt')
                    ->required()
                    ->maxLength(500)
                    ->label('Descripción'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('concurrencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('concurrencia_txt')
                    ->searchable()
                    ->label('Descripción'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Creado'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Actualizado'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConcurrencias::route('/'),
            'create' => Pages\CreateConcurrencia::route('/create'),
            'view' => Pages\ViewConcurrencia::route('/{record}'),
            'edit' => Pages\EditConcurrencia::route('/{record}/edit'),
        ];
    }
}
