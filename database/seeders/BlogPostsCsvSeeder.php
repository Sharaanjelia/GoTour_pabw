<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogPostsCsvSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/exports/blog_posts.csv');
        if (!file_exists($path)) {
            $this->command->error("File blog_posts.csv tidak ditemukan di $path");
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
            if (!DB::table('blog_posts')->where('id', $data['id'])->exists()) {
                DB::table('blog_posts')->insert($data);
            }
        }
        $this->command->info('blog_posts.csv berhasil diimport ke tabel blog_posts.');
    }
}
