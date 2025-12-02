<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        Discount::factory()->count(4)->create();
    }
}
