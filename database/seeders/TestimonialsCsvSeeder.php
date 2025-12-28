<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialsCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/testimonials.csv');
        if (!file_exists($path)) {
            $this->command->error("File testimonials.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            if (count($row) !== count($header)) continue;
            $data = array_combine($header, $row);
            if (isset($data['user_id']) && ($data['user_id'] === '' || is_null($data['user_id']))) {
                $data['user_id'] = null;
            }
            if (isset($data['payment_id']) && ($data['payment_id'] === '' || is_null($data['payment_id']))) {
                $data['payment_id'] = null;
            }
            if (isset($data['rating']) && ($data['rating'] === '' || is_null($data['rating']))) {
                $data['rating'] = null;
            }
            if (!DB::table('testimonials')->where('id', $data['id'])->exists()) {
                DB::table('testimonials')->insert($data);
            }
        }
        $this->command->info('testimonials.csv berhasil diimport ke tabel testimonials.');
    }
}
