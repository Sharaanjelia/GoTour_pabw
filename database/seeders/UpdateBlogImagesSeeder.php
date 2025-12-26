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
            'glamping-seru-di-bandung-rekomendasi-untuk-liburan-keluarga' => 'storage/blog/Glamping Seru di Bandung Rekomendasi untuk Liburannn.jpeg',
            'menjelajahi-kesejukan-kebun-teh-rancabali-di-ciwidey' => 'storage/blog/Kebun Teh Rancabali di Ciwidey.jpeg',
            '5-rekomendasi-tempat-makan-sunda-autentik-di-lembang' => 'storage/blog/Tempat Makan Sunda Autentik di Lembang.jpeg',
            'wisata-sejarah-menelusuri-gedung-bersejarah-di-bandung' => 'storage/blog/Wisata Sejarah Menelusuri Gedung Bersejarah di Bandung.jpeg',
            'kopi-bandung-7-coffee-shop-dengan-view-terbaik' => 'storage/blog/Kopi Bandung 7 Coffee Shop dengan View Terbaik.jpeg',
            'panduan-lengkap-berkunjung-ke-kawah-putih-ciwidey' => 'storage/blog/Panduan Lengkap Berkunjung ke Kawah Putih Ciwidey.jpeg',
            'tempat-nongkrong-hits-di-bandung-untuk-anak-muda' => 'storage/blog/Tempat Nongkrong Hits di Bandung untuk Anak Muda.jpeg',
            'belanja-di-bandung-factory-outlet-dan-distro-terbaik' => 'storage/blog/Belanja di Bandung Factory Outlet dan Distro Terbaik.jpeg',
            'jalan-jalan-malam-di-bandung-tempat-wisata-malam-terbaik' => 'storage/blog/Jalan-Jalan Malam di Bandung Tempat Wisata Malam Terbaik.jpeg',
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
