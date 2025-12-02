<?php

namespace Database\Factories;

use App\Models\PhotoRecommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoRecommendationFactory extends Factory
{
    protected $model = PhotoRecommendation::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
