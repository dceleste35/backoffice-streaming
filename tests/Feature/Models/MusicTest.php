<?php

use App\Models\Music;
use App\Models\User;

it('can have many users', function () {
    $music = Music::factory()
        ->hasAttached(User::factory()->count(3))
        ->create();

    expect($music->users)->toHaveCount(3);
});
