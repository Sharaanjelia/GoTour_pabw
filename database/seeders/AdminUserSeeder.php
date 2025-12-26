<?php
// Seeder diaktifkan. Menambahkan data admin dan user dummy ke dalam tabel users.

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Menambahkan data admin dan user dummy ke dalam tabel users.
     */
    public function run(): void
    {
        $users = [
            // Admins
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
            // Regular users
            [
                'name' => 'Raka Pratama',
                'email' => 'raka.pratama@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Naila Salsabila',
                'email' => 'naila.salsabila@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Farren Reyhan',
                'email' => 'farren.reyhan@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Kayla Putri',
                'email' => 'kayla.putri@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Ryu Santoso',
                'email' => 'ryu.santoso@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Amara Khairunnisa',
                'email' => 'amara.khairunnisa@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Devian Daffa',
                'email' => 'devian.daffa@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Tia Maharani',
                'email' => 'tia.maharani@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
        ];
        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
