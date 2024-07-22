<?php

namespace App\Filament\Resources\GenreResource\RelationManagers;

use App\Filament\Resources\MusicResource;
use App\Models\Music;
use Filament\Forms;
use Filament\Forms\Components\Select;
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter une musique')
                    ->form([
                        Select::make('music_id')
                            ->label('Musique')
                            ->searchable()
                            ->options(
                                Music::all()->pluck('title', 'id')
                            )
                            ->required(),
                    ])
                    ->action(fn (array $data) => $this->getOwnerRecord()->music()->attach($data['music_id'])),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(fn ($record) => MusicResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->label(''),
            ])
            ->bulkActions([
                //
            ]);
    }
}
