<?php

use App\Models\Album;
use App\Models\Artist;
use App\Models\Music;

it('can have multiple albums', function () {
    $artist = Artist::factory()
        ->has(Album::factory()->count(3))
        ->create();

    expect($artist->albums)->toHaveCount(3);
});

it('can have many music', function () {
    $artist = Artist::factory()
        ->hasAttached(Music::factory()->count(3))
        ->create();

    expect($artist->music)->toHaveCount(3);
});
