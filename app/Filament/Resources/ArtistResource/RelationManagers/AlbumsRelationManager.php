<?php

namespace App\Filament\Resources\ArtistResource\RelationManagers;

use App\Filament\Resources\AlbumResource;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class AlbumsRelationManager extends RelationManager
{
    protected static string $relationship = 'albums';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter un album')
                    ->form([
                        Forms\Components\Select::make('album_id')
                            ->label('Album')
                            ->searchable()
                            ->options(
                                Album::all()->pluck('title', 'id')
                            )
                            ->required(),
                    ])
                    ->action(fn (array $data) => $this->getOwnerRecord()->albums()->attach($data['album_id'])),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(fn ($record) => AlbumResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                //
            ]);
    }
}
