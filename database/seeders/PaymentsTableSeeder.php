<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentsTableSeeder extends Seeder
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

        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            // Sesuaikan nama tabel dan kolom jika perlu
            DB::table('payments')->insert($data);
        }
        $this->command->info('Data payments.csv berhasil diimport ke tabel payments.');
    }
}
