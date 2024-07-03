<?php

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
