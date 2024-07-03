<?php

use App\Models\Album;
use App\Models\Artist;

it('can have an artist', function () {
    $album = Album::factory()->create(['title' => 'test']);
    $artist = Artist::factory()->create(['name' => 'test']);

    $album->artist()->associate($artist);
    $album->save();

    expect($album->artist->name)->toBe('test');
});
