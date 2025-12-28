<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/cache.csv');
        if (!file_exists($path)) {
            $this->command->error("File cache.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            if (count($row) !== count($header)) continue;
            $data = array_combine($header, $row);
            if (!DB::table('cache')->where('key', $data['key'])->exists()) {
                DB::table('cache')->insert($data);
            }
        }
        $this->command->info('cache.csv berhasil diimport ke tabel cache.');
    }
}
