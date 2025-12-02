<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create a regular test user (idempotent)
        User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            // ensure a password is set so inserts don't fail on NOT NULL
            'password' => bcrypt('password'),
        ]);

        // create admin users + sample packages + content
        $this->call([
            AdminUserSeeder::class,
            PackageSeeder::class,
            BlogPostSeeder::class,
            DestinationSeeder::class,
            ServiceSeeder::class,
            DiscountSeeder::class,
            PhotoRecommendationSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
