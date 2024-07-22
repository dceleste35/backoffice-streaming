<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class MusicRelationManager extends RelationManager
{
    protected static string $relationship = 'music';

    protected static ?string $title = 'Likées';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label('Titre'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                EditAction::make()
                    ->label(''),
                // ->url(fn (Model $record): string => MusicResource::getUrl('edit', ['record' => $record])), // TODO : waiting for MusicResource
            ])
            ->bulkActions([
                //
            ]);
    }
}
