<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrationsCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/migrations.csv');
        if (!file_exists($path)) {
            $this->command->error("File migrations.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            if (count($row) !== count($header)) continue;
            $data = array_combine($header, $row);
            if (!DB::table('migrations')->where('id', $data['id'])->exists()) {
                DB::table('migrations')->insert($data);
            }
        }
        $this->command->info('migrations.csv berhasil diimport ke tabel migrations.');
    }
}
