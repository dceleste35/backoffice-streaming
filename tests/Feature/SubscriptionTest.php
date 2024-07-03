<?php

use App\Models\Subscription;
use App\Models\User;
use Database\Seeders\SubscriptionSeeder;
use Illuminate\Support\Carbon;

use function Pest\Laravel\seed;

it('can have users', function () {
    seed(SubscriptionSeeder::class);

    $user = User::factory()->create();
    $subscription = Subscription::first();

    $subscription->users()->attach($user, [
        'start_date' => now(),
        'end_date' => now()->addYear(),
    ]);

    expect($subscription->users)->toHaveCount(1);
    expect($subscription->users->first()->pivot->start_date)->toBeInstanceOf(Carbon::class);
    expect($subscription->users->first()->pivot->end_date)->toBeInstanceOf(Carbon::class);
});
