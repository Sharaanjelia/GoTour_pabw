<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class ImportBlogPostsSeeder extends Seeder
{
    public function run(): void
    {
        $csvPath = database_path('seeders/exports/blog_posts.csv');
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Baris pertama sebagai header

        foreach ($csv->getRecords() as $record) {
            DB::table('blog_posts')->updateOrInsert(
                ['id' => $record['id']],
                [
                    'title'         => $record['title'],
                    'slug'          => $record['slug'],
                    'excerpt'       => $record['excerpt'],
                    'content'       => $record['content'],
                    'cover_image'   => $record['cover_image'],
                    'user_id'       => $record['user_id'] ?: null,
                    'published_at'  => $record['published_at'],
                    'is_active'     => $record['is_active'],
                    'created_at'    => $record['created_at'],
                    'updated_at'    => $record['updated_at'],
                    'category'      => $record['category'],
                    'reading_time'  => $record['reading_time'],
                    'external_link' => $record['external_link'],
                ]
            );
        }

        $this->command->info('Blog posts imported from CSV!');
    }
}
