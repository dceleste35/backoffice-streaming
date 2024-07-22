<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MusicResource\Pages;
use App\Models\Music;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class MusicResource extends Resource
{
    protected static ?string $model = Music::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    protected static ?string $navigationLabel = 'Musiques';

    protected static ?string $pluralModelLabel = 'Musiques';

    protected static ?string $modelLabel = 'Musique';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                TimePicker::make('duration')
                    ->label('Durée')
                    ->required()
                    ->formatStateUsing(fn (string $state) => gmdate('H:i:s', $state)),
                DateTimePicker::make('release_date')
                    ->label('Date de sortie')
                    ->required()
                    ->native(false),
                FileUpload::make('file_path')
                    ->disk('covers')
                    ->visibility('public')
                    ->image()
                    ->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->disk('covers')
                    ->label('Cover'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->searchable(),
                Tables\Columns\TextColumn::make('release_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('play_count'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListMusic::route('/'),
            'create' => Pages\CreateMusic::route('/create'),
            'edit' => Pages\EditMusic::route('/{record}/edit'),
        ];
    }
}
