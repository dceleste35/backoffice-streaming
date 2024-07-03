<?php

use App\Models\Album;
use App\Models\Artist;
use App\Models\Music;

it('can have an artist', function () {
    $album = Album::factory()->create(['title' => 'test']);
    $artist = Artist::factory()->create(['name' => 'test']);

    $album->artist()->associate($artist);
    $album->save();

    expect($album->artist->name)->toBe('test');
});

it('can have many music', function () {
    $album = Album::factory()
        ->hasAttached(Music::factory()->count(3))
        ->create();

    expect($album->music)->toHaveCount(3);
});
