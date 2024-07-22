<?php

namespace App\Filament\Resources\MusicResource\Pages;

use App\Filament\Resources\MusicResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateMusic extends CreateRecord
{
    protected static string $resource = MusicResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['duration']) {
            $start = Carbon::createFromFormat('H:i:s', '00:00:00');
            $end = Carbon::createFromFormat('H:i:s', $data['duration']);

            $data['duration'] = $start->diffInSeconds($end);
        }

        return $data;
    }
}
