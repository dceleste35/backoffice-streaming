<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SubscriptionSeeder::class,
            PlaylistSeeder::class,
            RoleSeeder::class,
            MusicSeeder::class,
            UserSeeder::class,
        ]);
    }
}
