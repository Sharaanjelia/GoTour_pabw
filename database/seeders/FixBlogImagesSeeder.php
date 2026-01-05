<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class FixBlogImagesSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            ['id' => 1, 'cover_image' => 'blog/Kebun Teh Rancabali di Ciwidey.jpg'], // Menjelajahi Kesejukan Kebun Teh Rancabali di Ciwidey
            ['id' => 2, 'cover_image' => 'blog/Tempat Makan Sunda Autentik di Lembang.webp'], // 5 Rekomendasi Tempat Makan Sunda Autentik di Lembang
            ['id' => 3, 'cover_image' => 'blog/Glamping Lakeside Rancabali.webp'], // Glamping Seru di Bandung
            ['id' => 4, 'cover_image' => 'blog/Wisata Sejarah Menelusuri Gedung Bersejarah di Bandung.jpg'], // Wisata Sejarah: Menelusuri Gedung Bersejarah di Bandung
            ['id' => 5, 'cover_image' => 'blog/Kopi Bandung 7 Coffee Shop dengan View Terbaik.webp'], // Kopi Bandung: 7 Coffee Shop dengan View Terbaik
            ['id' => 6, 'cover_image' => 'blog/Panduan Lengkap Berkunjung ke Kawah Putih Ciwidey.jpg'], // Panduan Lengkap Berkunjung ke Kawah Putih Ciwidey
            ['id' => 7, 'cover_image' => 'blog/Tempat Nongkrong Hits di Bandung untuk Anak Muda.jpg'], // Tempat Nongkrong Hits di Bandung untuk Anak Muda
            ['id' => 8, 'cover_image' => 'blog/Belanja di Bandung Factory Outlet dan Distro Terbaik.webp'], // Belanja di Bandung: Factory Outlet dan Distro Terbaik
            ['id' => 9, 'cover_image' => 'blog/Jalan-Jalan Malam di Bandung Tempat Wisata Malam Terbaik.jpg'], // Jalan-Jalan Malam di Bandung: Tempat Wisata Malam Terbaik
        ];

        foreach ($blogs as $data) {
            BlogPost::where('id', $data['id'])->update(['cover_image' => $data['cover_image']]);
        }

        $this->command->info('✅ Gambar blog berhasil diupdate!');
    }
}
