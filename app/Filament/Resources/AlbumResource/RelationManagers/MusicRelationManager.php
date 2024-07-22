<?php

namespace App\Filament\Resources\AlbumResource\RelationManagers;

use App\Filament\Resources\MusicResource;
use App\Models\Music;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class MusicRelationManager extends RelationManager
{
    protected static string $relationship = 'music';

    protected static ?string $title = 'Morceaux';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre'),
                Tables\Columns\TextColumn::make('users_count')->counts('users')
                    ->label('Nombre de likes'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter un morceau')
                    ->form([
                        Forms\Components\Select::make('music_id')
                            ->label('Morceau')
                            ->searchable()
                            ->options(
                                Music::all()->pluck('title', 'id')
                            )
                            ->required(),
                    ])
                    ->action(fn (array $data) => $this->getOwnerRecord()->music()->attach($data['music_id'])),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(fn ($record) => MusicResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
