<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountsCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/discounts.csv');
        if (!file_exists($path)) {
            $this->command->error("File discounts.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            if (count($row) !== count($header)) continue;
            $data = array_combine($header, $row);
            if (isset($data['starts_at']) && ($data['starts_at'] === '' || is_null($data['starts_at']))) {
                $data['starts_at'] = null;
            }
            if (isset($data['ends_at']) && ($data['ends_at'] === '' || is_null($data['ends_at']))) {
                $data['ends_at'] = null;
            }
            if (!DB::table('discounts')->where('id', $data['id'])->exists()) {
                DB::table('discounts')->insert($data);
            }
        }
        $this->command->info('discounts.csv berhasil diimport ke tabel discounts.');
    }
}
