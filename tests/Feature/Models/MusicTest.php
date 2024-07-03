<?php

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Music;
use App\Models\Playlist;
use App\Models\User;

it('can have many users', function () {
    $music = Music::factory()
        ->hasAttached(User::factory()->count(3))
        ->create();

    expect($music->users)->toHaveCount(3);
});

it('can have many playlists', function () {
    $music = Music::factory()
        ->hasAttached(Playlist::factory()->count(3))
        ->create();

    expect($music->playlists)->toHaveCount(3);
});

it('can have many genres', function () {
    $music = Music::factory()
        ->hasAttached(Genre::factory()->count(3))
        ->create();

    expect($music->genres)->toHaveCount(3);
});

it('can have many artists', function () {
    $music = Music::factory()
        ->hasAttached(Artist::factory()->count(3))
        ->create();

    expect($music->artists)->toHaveCount(3);
});
