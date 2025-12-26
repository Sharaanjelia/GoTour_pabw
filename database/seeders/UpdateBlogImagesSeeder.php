<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class UpdateBlogImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update cover images untuk setiap artikel
        $updates = [
            'glamping-seru-di-bandung-rekomendasi-untuk-liburan-keluarga' => 'images/blog/Glamping Seru di Bandung Rekomendasi untuk Liburannn.webp',
            'menjelajahi-kesejukan-kebun-teh-rancabali-di-ciwidey' => 'images/blog/Kebun Teh Rancabali di Ciwidey.jpg',
            '5-rekomendasi-tempat-makan-sunda-autentik-di-lembang' => 'images/blog/Tempat Makan Sunda Autentik di Lembang.webp',
            'wisata-sejarah-menelusuri-gedung-bersejarah-di-bandung' => 'images/blog/Wisata Sejarah Menelusuri Gedung Bersejarah di Bandung.jpg',
            'kopi-bandung-7-coffee-shop-dengan-view-terbaik' => 'images/blog/Kopi Bandung 7 Coffee Shop dengan View Terbaik.webp',
            'panduan-lengkap-berkunjung-ke-kawah-putih-ciwidey' => 'images/blog/Panduan Lengkap Berkunjung ke Kawah Putih Ciwidey.jpg',
            'tempat-nongkrong-hits-di-bandung-untuk-anak-muda' => 'images/blog/Tempat Nongkrong Hits di Bandung untuk Anak Muda.jpg',
            'belanja-di-bandung-factory-outlet-dan-distro-terbaik' => 'images/blog/Belanja di Bandung Factory Outlet dan Distro Terbaik.webp',
            'jalan-jalan-malam-di-bandung-tempat-wisata-malam-terbaik' => 'images/blog/Jalan-Jalan Malam di Bandung Tempat Wisata Malam Terbaik.jpg',
        ];

        foreach ($updates as $slug => $imagePath) {
            $post = BlogPost::where('slug', $slug)->first();
            if ($post) {
                $post->update(['cover_image' => $imagePath]);
                echo "✓ Updated: {$post->title}\n";
            }
        }

        echo "\n✅ Semua gambar blog berhasil diupdate!\n";
    }
}
