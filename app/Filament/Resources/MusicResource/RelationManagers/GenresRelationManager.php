<?php

namespace App\Filament\Resources\MusicResource\RelationManagers;

use App\Models\Genre;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GenresRelationManager extends RelationManager
{
    protected static string $relationship = 'genres';

    protected static ?string $title = 'Genres';

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
                TextColumn::make('name'),
                TextColumn::make('description'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->label('Ajouter un genre')
                    ->form([
                        Select::make('genre_id')
                            ->label('Genre')
                            ->searchable()
                            ->options(
                                Genre::all()->pluck('name', 'id')
                            )
                            ->required(),
                    ])
                    ->action(fn (array $data) => $this->getOwnerRecord()->genres()->attach($data)),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
