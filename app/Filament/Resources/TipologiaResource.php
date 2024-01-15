<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipologiaResource\Pages;
use App\Filament\Resources\TipologiaResource\RelationManagers;
use App\Models\Tipologia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipologiaResource extends Resource
{
    protected static ?string $model = Tipologia::class;
    protected static ?string $navigationLabel = 'Tipología';
    protected static ?string $modelLabel = 'Tipología ';

    protected static ?string $navigationGroup = 'Características';
    protected static ?string $slug = 'tipologia';
    protected static ?int $navigationSort = 3;       

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(1000)
                    ->label('Descripción'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cod_tipologia')
                    ->numeric()
                    ->sortable()
                    ->label('Código'),
                Tables\Columns\TextColumn::make('descripcion')
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
            'index' => Pages\ListTipologias::route('/'),
            'create' => Pages\CreateTipologia::route('/create'),
            'view' => Pages\ViewTipologia::route('/{record}'),
            'edit' => Pages\EditTipologia::route('/{record}/edit'),
        ];
    }
}
