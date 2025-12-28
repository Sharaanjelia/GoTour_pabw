<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
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

        $packageIds = [];
        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            if (!empty($data['package_id'])) {
                $packageIds[$data['package_id']] = [
                    'id' => $data['package_id'],
                    'user_id' => $data['user_id'] ?? null,
                    'title' => 'Package '.$data['package_id'],
                    'slug' => 'package-'.$data['package_id'],
                    'price' => $data['amount'] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        foreach ($packageIds as $package) {
            // Insert only if not exists
            if (!DB::table('packages')->where('id', $package['id'])->exists()) {
                DB::table('packages')->insert($package);
            }
        }
        $this->command->info('Package dari payments.csv berhasil diimport ke tabel packages.');
    }
}
