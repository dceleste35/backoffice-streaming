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
        Subscription::factory()->create([
            'name' => 'free',
            'price' => 0,
        ]);

        Subscription::factory()->create([
            'name' => 'standard',
            'price' => 10,
        ]);

        Subscription::factory()->create([
            'name' => 'premium',
            'price' => 20,
        ]);

        Subscription::factory()->create([
            'name' => 'lifetime',
            'price' => 100,
        ]);
    }
}
