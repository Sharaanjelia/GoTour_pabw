<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/payments.csv');
        if (!file_exists($path)) {
            $this->command->error("File payments.csv tidak ditemukan di $path");
            return;
        }

        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);

        $userIds = [];
        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            if (!empty($data['user_id'])) {
                $userIds[$data['user_id']] = [
                    'id' => $data['user_id'],
                    'name' => $data['full_name'] ?? 'User'.$data['user_id'],
                    'email' => $data['email'] ?? 'user'.$data['user_id'].'@example.com',
                    'password' => bcrypt('password'),
                    'phone' => $data['phone'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        foreach ($userIds as $user) {
            // Insert only if not exists
            if (!DB::table('users')->where('id', $user['id'])->exists()) {
                DB::table('users')->insert($user);
            }
        }
        $this->command->info('User dari payments.csv berhasil diimport ke tabel users.');
    }
}
