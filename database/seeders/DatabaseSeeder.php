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
        // Import semua data dari CSV exports
        $this->call([
            UsersCsvSeeder::class,
            PackagesCsvSeeder::class,
            BlogPostsCsvSeeder::class,
            DiscountsCsvSeeder::class,
            ServicesCsvSeeder::class,
            TestimonialsCsvSeeder::class,
            PhotoRecommendationsCsvSeeder::class,
            PaymentsCsvSeeder::class,
            CacheCsvSeeder::class,
            SessionsCsvSeeder::class,
            MigrationsCsvSeeder::class,
        ]);
    }
}
