<?php
// Seeder dinonaktifkan. Data diambil dari SQL dump, tidak perlu insert apapun di sini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seeder dinonaktifkan, gunakan SQL dump untuk data.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Pemandu Wisata',
                'slug' => 'pemandu-wisata',
                'description' => 'Kami menyediakan pemandu wisata berpengalaman untuk membantu Anda menjelajahi destinasi terbaik.',
                'image' => 'services/foto pemandu wisata.png',
                'is_active' => true,
            ],
            [
                'name' => 'Transportasi',
                'slug' => 'transportasi',
                'description' => 'Transportasi yang nyaman dan aman untuk perjalanan Anda selama berwisata.',
                'image' => 'services/transportasi.jpeg',
                'is_active' => true,
            ],
            [
                'name' => 'Paket Kustom',
                'slug' => 'paket-kustom',
                'description' => 'Sesuaikan paket wisata Anda sesuai dengan kebutuhan dan preferensi Anda.',
                'image' => 'services/paket kostum.jpeg',
                'is_active' => true,
            ],
            [
                'name' => 'Informasi Wisata',
                'slug' => 'informasi-wisata',
                'description' => 'Menyediakan informasi lengkap tentang destinasi wisata, termasuk tips dan rekomendasi untuk perjalanan di Bandung.',
                'image' => 'services/informasi wisata.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Aktivitas Tambahan',
                'slug' => 'aktivitas-tambahan',
                'description' => 'Menyediakan berbagai aktivitas tambahan seperti snorkeling, diving, atau kelas memasak untuk pengalaman yang lebih mendalam',
                'image' => 'services/snorkeling.jpeg',
                'is_active' => true,
            ],
            [
                'name' => 'Akomodasi',
                'slug' => 'akomodasi',
                'description' => 'Menyediakan pilihan penginapan, mulai dari hotel bintang lima hingga homestay, untuk kenyamanan wisatawan.',
                'image' => 'services/akomodasi.jpeg',
                'is_active' => true,
            ],
            [
                'name' => 'Paket Makan dan Minum',
                'slug' => 'paket-makan-dan-minum',
                'description' => 'Menawarkan opsi paket makan yang mencakup makanan lokal atau internasional selama tour.',
                'image' => 'services/paket makan.jpeg',
                'is_active' => true,
            ],
            [
                'name' => 'Layanan 24 Jam',
                'slug' => 'layanan-24-jam',
                'description' => 'Dukungan pelanggan yang tersedia 24 jam untuk membantu wisatawan dengan pertanyaan atau masalah yang mungkin timbul selama perjalanan.',
                'image' => 'services/layanan 24jam.webp',
                'is_active' => true,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Service::create($item);
        }
    }
}
