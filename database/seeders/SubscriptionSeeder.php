<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'name' => 'free',
            'price' => 0,
        ]);

        Subscription::create([
            'name' => 'standard',
            'price' => 10,
        ]);

        Subscription::create([
            'name' => 'premium',
            'price' => 20,
        ]);

        Subscription::create([
            'name' => 'lifetime',
            'price' => 100,
        ]);
    }
}
