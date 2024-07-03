<?php

use App\Models\Album;
use App\Models\Artist;

it('can have multiple albums', function () {
    $artist = Artist::factory()
        ->has(Album::factory()->count(3))
        ->create();

    expect($artist->albums)->toHaveCount(3);
});
