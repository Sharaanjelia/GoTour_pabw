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
                'description' => 'Pose duduk santai yang cocok untuk foto outdoor dengan background alam',
                'category' => 'portrait',
                'tips' => 'Pilih lokasi dengan cahaya natural yang lembut, seperti sore hari. Posisikan tubuh sedikit miring untuk hasil lebih dinamis.',
                'image' => 'photos/gya fto 2.avif',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 2',
                'description' => 'Pose menikmati alam dengan ekspresi natural dan rileks',
                'category' => 'nature',
                'tips' => 'Gunakan golden hour (1 jam sebelum sunset) untuk cahaya terbaik. Ekspresi rileks dan tatap ke arah pemandangan.',
                'image' => 'photos/gya fto 1.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 3',
                'description' => 'Ekspresi bebas dan natural untuk foto candid yang autentik',
                'category' => 'portrait',
                'tips' => 'Jangan terlalu kaku, biarkan ekspresi natural keluar. Photographer bisa ajak ngobrol untuk hasil lebih natural.',
                'image' => 'photos/gya fto 3.avif',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 4',
                'description' => 'Pose ceria dengan senyum natural yang hangat',
                'category' => 'portrait',
                'tips' => 'Senyum dari hati, bukan dipaksakan. Pikirkan hal menyenangkan agar senyum terlihat genuine.',
                'image' => 'photos/gya fto 14.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 5',
                'description' => 'Pose santai berdiri dengan gaya casual yang stylish',
                'category' => 'urban',
                'tips' => 'Berdiri dengan santai, satu kaki bisa sedikit ditekuk. Tangan bisa masuk ke saku atau santai di samping.',
                'image' => 'photos/gya fto 5.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 6',
                'description' => 'Pose santai di jalan untuk foto travel yang natural',
                'category' => 'travel',
                'tips' => 'Berjalan dengan santai, tidak perlu terlalu pose. Hasil terbaik dengan continuous shooting mode.',
                'image' => 'photos/gya fto 6.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 7',
                'description' => 'Pose liburan yang fun dan memorable',
                'category' => 'travel',
                'tips' => 'Tunjukkan emosi bahagia saat liburan. Background destinasi wisata akan membuat foto lebih bercerita.',
                'image' => 'photos/gya fto 7.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 8',
                'description' => 'Pose elegan untuk foto formal atau semi-formal',
                'category' => 'portrait',
                'tips' => 'Postur tegap, dagu sedikit terangkat. Tatapan percaya diri ke kamera atau ke samping.',
                'image' => 'photos/gya fto 16.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 9',
                'description' => 'Pose berjalan santai untuk foto candid yang dinamis',
                'category' => 'travel',
                'tips' => 'Berjalan dengan kecepatan normal, photographer gunakan burst mode. Lihat ke depan atau sedikit ke samping.',
                'image' => 'photos/gya fto 10.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 10',
                'description' => 'Casual natural pose untuk foto sehari-hari',
                'category' => 'urban',
                'tips' => 'Berpose dengan natural seperti sedang melakukan aktivitas biasa. Hindari pose yang terlalu kaku.',
                'image' => 'photos/gya fto 11.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 11',
                'description' => 'Headphone dan pemandangan kota untuk foto urban lifestyle',
                'category' => 'urban',
                'tips' => 'Gunakan headphone sebagai props. Background kota dengan bokeh effect akan menambah estetika.',
                'image' => 'photos/gya foto 12.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Gaya Foto 12',
                'description' => 'Playful candid pose untuk foto yang fun dan energik',
                'category' => 'portrait',
                'tips' => 'Bergerak bebas dan ekspresif. Photographer tangkap moment-moment spontan untuk hasil terbaik.',
                'image' => 'photos/gya fto 13.jpg',
                'is_active' => true,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\PhotoRecommendation::create($item);
        }
    }
}
