<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->bothify('SALE###')),
            'percent' => $this->faker->numberBetween(5,50),
            'description' => $this->faker->sentence(),
            'starts_at' => now()->subDays(rand(0,30)),
            'ends_at' => now()->addDays(rand(7,60)),
            'is_active' => true,
        ];
    }
}
