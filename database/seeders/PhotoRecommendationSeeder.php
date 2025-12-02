<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhotoRecommendation;

class PhotoRecommendationSeeder extends Seeder
{
    public function run(): void
    {
        PhotoRecommendation::factory()->count(10)->create();
    }
}
