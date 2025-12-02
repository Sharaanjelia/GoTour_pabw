<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class FixNullPasswordsSeeder extends Seeder
{
    public function run(): void
    {
        // set a safe default password for any user that has NULL password
        $count = User::whereNull('password')->count();
        if ($count) {
            User::whereNull('password')->update(['password' => bcrypt('password')]);
        }
    }
}
