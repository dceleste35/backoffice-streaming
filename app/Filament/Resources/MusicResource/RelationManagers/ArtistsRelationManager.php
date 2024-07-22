<?php

namespace App\Filament\Resources\MusicResource\RelationManagers;

use App\Filament\Resources\ArtistResource;
use App\Models\Artist;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class ArtistsRelationManager extends RelationManager
{
    protected static string $relationship = 'artists';

    protected static ?string $title = 'Artistes';

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
            ->recordTitleAttribute('Artiste')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter un artiste')
                    ->form([
                        Select::make('artist_id')
                            ->label('Artiste')
                            ->searchable()
                            ->options(
                                Artist::all()->pluck('name', 'id')
                            )
                            ->required(),
                    ])
                    ->action(fn (array $data) => $this->getOwnerRecord()->artists()->attach($data['artist_id'])),

            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->requiresConfirmation(),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(fn ($record) => ArtistResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
