<?php
// Seeder dinonaktifkan. Data diambil dari SQL dump, tidak perlu insert apapun di sini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Seeder dinonaktifkan, gunakan SQL dump untuk data.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'SALE2024',
                'percent' => 20,
                'description' => 'Diskon awal tahun 2024 untuk semua paket wisata.',
                'is_active' => true,
            ],
            [
                'code' => 'LIBURANHEMAT',
                'percent' => 15,
                'description' => 'Promo liburan hemat untuk keluarga.',
                'is_active' => true,
            ],
            [
                'code' => 'WEEKEND10',
                'percent' => 10,
                'description' => 'Diskon spesial akhir pekan.',
                'is_active' => true,
            ],
            [
                'code' => 'STUDENT5',
                'percent' => 5,
                'description' => 'Diskon untuk pelajar dan mahasiswa.',
                'is_active' => true,
            ],
            [
                'code' => 'EARLYBIRD',
                'percent' => 12,
                'description' => 'Diskon untuk pemesanan jauh hari.',
                'is_active' => true,
            ],
            [
                'code' => 'GROUP25',
                'percent' => 25,
                'description' => 'Diskon untuk rombongan minimal 5 orang.',
                'is_active' => true,
            ],
            [
                'code' => 'BANDUNGTRIP',
                'percent' => 18,
                'description' => 'Promo khusus destinasi Bandung.',
                'is_active' => true,
            ],
            [
                'code' => 'FLASHSALE',
                'percent' => 30,
                'description' => 'Flash sale terbatas untuk paket tertentu.',
                'is_active' => true,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Discount::create($item);
        }
    }
}
