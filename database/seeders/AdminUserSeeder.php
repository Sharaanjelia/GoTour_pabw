<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // create a default admin if it doesn't exist
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin Default',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // additional admin for testing
        User::firstOrCreate([
            'email' => 'admin2@example.com',
        ], [
            'name' => 'Admin Two',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    }
}
