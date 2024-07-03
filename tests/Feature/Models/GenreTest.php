<?php

use App\Models\Genre;
use App\Models\Music;

it('can have many music', function () {
    $genre = Genre::factory()
        ->hasAttached(Music::factory()->count(3))
        ->create();

    expect($genre->music)->toHaveCount(3);
});
