<?php

use App\Models\Music;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Database\Seeders\SubscriptionSeeder;
use Illuminate\Support\Carbon;

use function Pest\Laravel\seed;

it('can have subscriptions', function () {
    seed(SubscriptionSeeder::class);

    $user = User::factory()->create();
    $subscription = Subscription::first();

    $user->subscriptions()->attach($subscription, [
        'start_date' => now(),
        'end_date' => now()->addYear(),
    ]);

    expect($user->subscriptions)->toHaveCount(1);
    expect($user->subscriptions->first()->pivot->start_date)->toBeInstanceOf(Carbon::class);
    expect($user->subscriptions->first()->pivot->end_date)->toBeInstanceOf(Carbon::class);
});

it('have a role', function () {

    $user = User::factory()->create();
    $role = Role::factory()->create();

    $user->update([
        'role_id' => $role->id,
    ]);

    expect($user->role->name)->toBe('user');
});

it('can have a playlist', function () {
    $user = User::factory()->create();
    $playlist = $user->playlists()->create(['title' => 'test']);

    expect($playlist->title)->toBe('test');
    expect($playlist->user)->toBeInstanceOf(User::class);
});

it('can have many playlists', function () {
    $user = User::factory()->create();
    $playlists = $user->playlists()->createMany([
        ['title' => 'test1'],
        ['title' => 'test2'],
        ['title' => 'test3'],
    ]);

    expect($user->playlists)->toHaveCount(3);
});

it('can have many musics liked', function () {
    $user = User::factory()
        ->hasAttached(Music::factory()->count(3))
        ->create();

    expect($user->music)->toHaveCount(3);
});
