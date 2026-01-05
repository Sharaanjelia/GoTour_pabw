<?php

namespace Database\Factories;

use App\Models\PhotoRecommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoRecommendationFactory extends Factory
{
    protected $model = PhotoRecommendation::class;

    public function definition()
    {
        $categories = ['landscape', 'portrait', 'nature', 'urban', 'travel', 'wildlife', 'architecture'];
        
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement($categories),
            'tips' => $this->faker->paragraph(2),
            'is_active' => true,
        ];
    }
}
