<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/users.csv');
        if (!file_exists($path)) {
            $this->command->error("File users.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                $data['password'] = Hash::make('password');
            }
            // Perbaiki email_verified_at jika kosong
            if (isset($data['email_verified_at']) && ($data['email_verified_at'] === '' || is_null($data['email_verified_at']))) {
                $data['email_verified_at'] = null;
            }
            // Perbaiki created_at dan updated_at jika kosong
            if (isset($data['created_at']) && ($data['created_at'] === '' || is_null($data['created_at']))) {
                $data['created_at'] = now();
            }
            if (isset($data['updated_at']) && ($data['updated_at'] === '' || is_null($data['updated_at']))) {
                $data['updated_at'] = now();
            }
            if (!DB::table('users')->where('id', $data['id'])->exists()) {
                DB::table('users')->insert($data);
            }
        }
        $this->command->info('users.csv berhasil diimport ke tabel users.');
    }
}
