<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    protected static ?string $title = 'Abonnements';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->badge()
                    ->label('Type d\'abonnement'),
                Tables\Columns\TextColumn::make('pivot.start_date')
                    ->label('Date de début')
                    ->date(),
                Tables\Columns\TextColumn::make('pivot.end_date')
                    ->label('Date de fin')
                    ->date(),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
