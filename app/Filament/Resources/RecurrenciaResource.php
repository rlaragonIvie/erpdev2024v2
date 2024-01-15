<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecurrenciaResource\Pages;
use App\Filament\Resources\RecurrenciaResource\RelationManagers;
use App\Models\Recurrencia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecurrenciaResource extends Resource
{
    protected static ?string $model = Recurrencia::class;
    protected static ?string $navigationLabel = 'Tipo de recurrencia';
    protected static ?string $modelLabel = 'Tipo de recurrencia ';

    protected static ?string $navigationGroup = 'Características';
    protected static ?string $slug = 'tipo-de-recurrencia';
    protected static ?int $navigationSort = 2;     

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('recurrencia_txt')
                    ->required()
                    ->maxLength(500)
                    ->label('Descripción'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recurrencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('recurrencia_txt')
                    ->searchable()
                    ->label('Descripción'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListRecurrencias::route('/'),
            'create' => Pages\CreateRecurrencia::route('/create'),
            'view' => Pages\ViewRecurrencia::route('/{record}'),
            'edit' => Pages\EditRecurrencia::route('/{record}/edit'),
        ];
    }
}
