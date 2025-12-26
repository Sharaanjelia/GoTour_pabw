<?php
// Seeder diaktifkan. Menambahkan 10 data admin user dummy ke dalam tabel users.

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Menambahkan 10 data admin user dummy ke dalam tabel users.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin Satu',
                'email' => 'admin1@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Dua',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Tiga',
                'email' => 'admin3@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Empat',
                'email' => 'admin4@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Lima',
                'email' => 'admin5@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Enam',
                'email' => 'admin6@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Tujuh',
                'email' => 'admin7@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Delapan',
                'email' => 'admin8@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Sembilan',
                'email' => 'admin9@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Sepuluh',
                'email' => 'admin10@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
        ];
        foreach ($admins as $admin) {
            DB::table('users')->updateOrInsert(
                ['email' => $admin['email']],
                $admin
            );
        }
    }
}
