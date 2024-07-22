<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlaylistsRelationManager extends RelationManager
{
    protected static string $relationship = 'playlists';

    protected static ?string $title = 'Playlists';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Nom de la playlist')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Playlist')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label('Nom de la playlist'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label(''),
                Action::make('list')
                    ->label('')
                    ->icon('heroicon-o-musical-note'),
            ])
            ->bulkActions([
                //
            ]);
    }
}
