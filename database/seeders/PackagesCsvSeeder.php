<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/packages.csv');
        if (!file_exists($path)) {
            $this->command->error("File packages.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            if (count($row) !== count($header)) continue;
            $data = array_combine($header, $row);
            // Perbaiki kolom yang kosong
            foreach ([
                'excerpt','description','duration','cover_image','itinerary','created_at','updated_at'
            ] as $col) {
                if (isset($data[$col]) && ($data[$col] === '' || is_null($data[$col]))) {
                    $data[$col] = null;
                }
            }
            // Pastikan boolean
            $data['featured'] = (isset($data['featured']) && $data['featured'] == '1') ? 1 : 0;
            $data['is_active'] = (isset($data['is_active']) && $data['is_active'] == '1') ? 1 : 0;
            // Insert jika belum ada
            if (!DB::table('packages')->where('id', $data['id'])->exists()) {
                DB::table('packages')->insert($data);
            }
        }
        $this->command->info('packages.csv berhasil diimport ke tabel packages.');
    }
}
