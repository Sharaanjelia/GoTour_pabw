<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoRecommendationsCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/photo_recommendations.csv');
        if (!file_exists($path)) {
            $this->command->error("File photo_recommendations.csv tidak ditemukan di $path");
            return;
        }
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', $csv[0]);
        unset($csv[0]);
        foreach ($csv as $row) {
            if (count($row) !== count($header)) continue;
            $data = array_combine($header, $row);
            if (!DB::table('photo_recommendations')->where('id', $data['id'])->exists()) {
                DB::table('photo_recommendations')->insert($data);
            }
        }
        $this->command->info('photo_recommendations.csv berhasil diimport ke tabel photo_recommendations.');
    }
}
