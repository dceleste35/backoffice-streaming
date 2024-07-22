<?php

namespace App\Filament\Resources\ArtistResource\RelationManagers;

use App\Filament\Resources\MusicResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class MusicRelationManager extends RelationManager
{
    protected static string $relationship = 'music';

    protected static ?string $title = 'Musiques';

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
                Tables\Columns\TextColumn::make('users_count')->counts('users')
                    ->label('Nombre de likes'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter une musique')
                    ->form([
                        Forms\Components\Select::make('music_id')
                            ->label('Musique')
                            ->searchable()
                            ->options(
                                \App\Models\Music::all()->pluck('title', 'id')
                            )
                            ->required(),
                    ])
                    ->action(fn (array $data) => $this->getOwnerRecord()->music()->attach($data['music_id'])),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(fn ($record) => MusicResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                //
            ]);
    }
}
