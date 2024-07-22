<?php

namespace App\Filament\Resources\MusicResource\Pages;

use App\Filament\Resources\MusicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditMusic extends EditRecord
{
    protected static string $resource = MusicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['duration']) {
            $start = \Carbon\Carbon::createFromFormat('H:i:s', '00:00:00');
            $end = \Carbon\Carbon::createFromFormat('H:i:s', $data['duration']);

            $data['duration'] = $start->diffInSeconds($end);
        }

        $record->update($data);

        return $record;
    }
}
