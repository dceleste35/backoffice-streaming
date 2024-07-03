<?php

use App\Models\Music;
use App\Models\Playlist;
use App\Models\User;

it('can have a user', function () {
    $playlist = Playlist::factory()->create(['title' => 'test']);

    expect($playlist->title)->toBe('test');
    expect($playlist->user)->toBeInstanceOf(User::class);
});

it('can have many Music', function () {
    $playlist = Playlist::factory()
        ->hasAttached(Music::factory()->count(3))
        ->create();

    expect($playlist->music)->toHaveCount(3);
});
