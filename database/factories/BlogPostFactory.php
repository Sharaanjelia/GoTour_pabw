<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        $title = $this->faker->sentence(6);
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1,9999),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(4, true),
            'published_at' => $this->faker->optional()->dateTimeBetween('-6 months','now'),
            'is_active' => true,
        ];
    }
}
