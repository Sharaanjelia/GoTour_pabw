<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence(3);
        return [
            'user_id' => null,
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->randomNumber(3),
            'excerpt' => $this->faker->paragraph(2),
            'description' => $this->faker->paragraphs(4, true),
            'duration' => $this->faker->randomElement(['1 Hari 0 Malam','1 Hari 2 Malam','2 Hari 1 Malam','3 Hari 2 Malam']),
            'price' => $this->faker->numberBetween(100000, 5000000),
            'cover_image' => null,
            'featured' => $this->faker->boolean(20),
            'is_active' => true,
        ];
    }
}
