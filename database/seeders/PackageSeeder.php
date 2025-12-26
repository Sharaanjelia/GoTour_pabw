<?php
// Seeder dinonaktifkan. Data diambil dari SQL dump, tidak perlu insert apapun di sini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Seeder dinonaktifkan, gunakan SQL dump untuk data.
     */
    public function run(): void
    {
        // Contoh data paket dengan itinerary
        \App\Models\Package::updateOrCreate([
            'slug' => 'tebing-karaton',
        ], [
            'user_id' => 1,
            'title' => 'Tebing Karaton',
            'slug' => 'tebing-karaton',
            'excerpt' => 'Paket wisata Tebing Karaton, Bandung',
            'description' => 'Nikmati sunrise dan pemandangan hutan dari Tebing Karaton.',
            'duration' => '2 Hari 2 Malam',
            'price' => 900000,
            'cover_image' => 'packages/tebing-karaton.jpg',
            'featured' => true,
            'is_active' => true,
            'itinerary' => [
                'Hari 1: Penjemputan, city tour, Tebing Karaton sunrise',
                'Hari 2: Wisata alam, kuliner, pulang',
            ],
        ]);
    }
}
