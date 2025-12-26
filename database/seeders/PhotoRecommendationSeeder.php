<?php
// Seeder diaktifkan untuk menambahkan data rekomendasi gaya foto dari HTML user.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhotoRecommendationSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk menambahkan data rekomendasi gaya foto.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Gaya Foto 1',
                'description' => 'Kategori: Pose Duduk',
                'image' => 'photos/gya fto 2.avif',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 2',
                'description' => 'Kategori: Pose Menikmati Alam',
                'image' => 'photos/gya fto 1.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 3',
                'description' => 'Kategori: Pose Ekspresi Bebas',
                'image' => 'photos/gya fto 3.avif',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 4',
                'description' => 'Kategori: Pose ceria',
                'image' => 'photos/gya fto 14.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 5',
                'description' => 'Kategori: Pose Santai Berdiri',
                'image' => 'photos/gya fto 5.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 6',
                'description' => 'Kategori: Pose Santai di Jalan',
                'image' => 'photos/gya fto 6.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 7',
                'description' => 'Kategori: Pose Liburan',
                'image' => 'photos/gya fto 7.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 8',
                'description' => 'Kategori: Pose Elegan',
                'image' => 'photos/gya fto 16.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 9',
                'description' => 'Kategori: Pose Berjalan Santai',
                'image' => 'photos/gya fto 10.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 10',
                'description' => 'Kategori: Casual Natural Pose',
                'image' => 'photos/gya fto 11.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 11',
                'description' => 'Kategori: Headphone dan Pemandangan Kota',
                'image' => 'photos/gya foto 12.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 12',
                'description' => 'Kategori: Playful Candid Pose',
                'image' => 'photos/gya fto 13.jpg',
                'is_active' => true,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\PhotoRecommendation::create($item);
        }
    }
}
