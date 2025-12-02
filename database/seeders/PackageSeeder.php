<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\User;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        // ensure at least one admin user exists
        $admin = User::where('email', 'admin@example.com')->first();
        if (!$admin) {
            // create via factory so password is set and hashed correctly
            $admin = User::factory()->create([
                'email' => 'admin@example.com',
                'name' => 'Admin User',
                'is_admin' => true,
            ]);
        } else {
            // make sure the found user is flagged as admin
            if (!$admin->is_admin) {
                $admin->is_admin = true;
                $admin->save();
            }
        }

        // create sample packages
        Package::factory()->count(9)->create([
            'user_id' => $admin->id,
        ]);
    }
}
