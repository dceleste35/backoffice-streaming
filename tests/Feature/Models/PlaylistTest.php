<?php

use App\Models\Playlist;
use App\Models\User;

it('can have a user', function () {
    $playlist = Playlist::factory()->create(['title' => 'test']);

    expect($playlist->title)->toBe('test');
    expect($playlist->user)->toBeInstanceOf(User::class);
});
