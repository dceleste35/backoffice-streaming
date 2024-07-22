<?php

namespace App\Filament\Resources\MusicResource\RelationManagers;

use App\Filament\Resources\AlbumResource;
use App\Models\Album;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlbumsRelationManager extends RelationManager
{
    protected static string $relationship = 'albums';

    protected static ?string $title = 'Albums';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('title')->label('Titre'),
                TextColumn::make('release_date')
                    ->label('Date de sortie')
                    ->dateTime(),
                TextColumn::make('artist.name')
                    ->label('Artiste'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter un album')
                    ->form([
                        Select::make('album_id')
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
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(fn ($record) => AlbumResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
