<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        BlogPost::truncate();

        $posts = [
            [
                'title' => 'Menjelajahi Kesejukan Kebun Teh Rancabali di Ciwidey',
                'slug' => 'menjelajahi-kesejukan-kebun-teh-rancabali-di-ciwidey',
                'category' => 'WISATA ALAM',
                'reading_time' => 6,
                'excerpt' => 'Bosan dengan hiruk pikuk kota? Simak panduan lengkap mengunjungi hamparan hijau kebun teh Rancabali, spot foto terbaik, hingga tips berkunjung agar terhindar dari...',
                'content' => '<p>Kebun Teh Rancabali di Ciwidey adalah salah satu destinasi wisata alam terpopuler di Bandung Selatan.</p>',
                'external_link' => 'https://www.google.com/search?q=kebun+teh+rancabali+ciwidey+bandung',
                'published_at' => now()->subDays(1),
                'is_active' => true,
            ],
            [
                'title' => '5 Rekomendasi Tempat Makan Sunda Autentik di Lembang',
                'slug' => '5-rekomendasi-tempat-makan-sunda-autentik-di-lembang',
                'category' => 'KULINER BANDUNG',
                'reading_time' => 5,
                'excerpt' => 'Nikmati sensasi makan di saung dengan pemandangan bukit. Kami merangkum tempat makan legendaris yang menyajikan nasi liwet dan sambal dadak terbaik di...',
                'content' => '<p>Lembang tidak hanya terkenal dengan wisata alamnya, tapi juga kuliner Sunda yang autentik.</p>',
                'external_link' => 'https://www.google.com/search?q=rekomendasi+tempat+makan+sunda+lembang+bandung',
                'published_at' => now()->subDays(2),
                'is_active' => true,
            ],
            [
                'title' => 'Glamping Seru di Bandung: Rekomendasi untuk Liburan Keluarga',
                'slug' => 'glamping-seru-di-bandung-rekomendasi-untuk-liburan-keluarga',
                'category' => 'STAYCATION',
                'reading_time' => 7,
                'excerpt' => 'Tren menginap di alam terbuka namun tetap mewah sedang populer di Bandung. Lihat daftar glamping terbaik dengan fasilitas lengkap dan udara yang super...',
                'content' => '<p>Glamping atau glamorous camping kini menjadi tren baru untuk liburan keluarga di Bandung.</p>',
                'external_link' => 'https://www.google.com/search?q=glamping+bandung+rekomendasi',
                'published_at' => now()->subDays(3),
                'is_active' => true,
            ],
            [
                'title' => 'Wisata Sejarah: Menelusuri Gedung Bersejarah di Bandung',
                'slug' => 'wisata-sejarah-menelusuri-gedung-bersejarah-di-bandung',
                'category' => 'WISATA SEJARAH',
                'reading_time' => 8,
                'excerpt' => 'Bandung memiliki banyak bangunan bersejarah peninggalan kolonial Belanda yang masih berdiri kokoh hingga kini. Mari kita telusuri jejak sejarah kota Bandung...',
                'content' => '<p>Kota Bandung dikenal sebagai Paris van Java karena keindahan arsitektur bangunannya.</p>',
                'external_link' => 'https://www.google.com/search?q=wisata+sejarah+gedung+bersejarah+bandung',
                'published_at' => now()->subDays(4),
                'is_active' => true,
            ],
            [
                'title' => 'Kopi Bandung: 7 Coffee Shop dengan View Terbaik',
                'slug' => 'kopi-bandung-7-coffee-shop-dengan-view-terbaik',
                'category' => 'KULINER BANDUNG',
                'reading_time' => 6,
                'excerpt' => 'Pecinta kopi wajib tahu! Berikut daftar coffee shop di Bandung yang tidak hanya menyajikan kopi berkualitas, tapi juga pemandangan yang Instagram-worthy...',
                'content' => '<p>Bandung adalah surganya pecinta kopi dengan banyak coffee shop berkonsep unik.</p>',
                'external_link' => 'https://www.google.com/search?q=coffee+shop+bandung+view+terbaik',
                'published_at' => now()->subDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'Panduan Lengkap Berkunjung ke Kawah Putih Ciwidey',
                'slug' => 'panduan-lengkap-berkunjung-ke-kawah-putih-ciwidey',
                'category' => 'WISATA ALAM',
                'reading_time' => 7,
                'excerpt' => 'Kawah Putih adalah ikon wisata Bandung yang wajib dikunjungi. Simak tips terbaik untuk berkunjung, jam buka, harga tiket, dan spot foto terbaik...',
                'content' => '<p>Kawah Putih merupakan danau kawah vulkanik dengan air berwarna putih kehijauan yang menakjubkan.</p>',
                'external_link' => 'https://www.google.com/search?q=panduan+kawah+putih+ciwidey+bandung',
                'published_at' => now()->subDays(6),
                'is_active' => true,
            ],
            [
                'title' => 'Tempat Nongkrong Hits di Bandung untuk Anak Muda',
                'slug' => 'tempat-nongkrong-hits-di-bandung-untuk-anak-muda',
                'category' => 'KULINER BANDUNG',
                'reading_time' => 5,
                'excerpt' => 'Cari tempat nongkrong yang aesthetic dan instagramable di Bandung? Simak rekomendasi cafe, resto, dan tempat hangout paling hits untuk anak muda...',
                'content' => '<p>Bandung memiliki banyak tempat nongkrong hits yang cocok untuk anak muda.</p>',
                'external_link' => 'https://www.google.com/search?q=tempat+nongkrong+hits+bandung+anak+muda',
                'published_at' => now()->subDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Belanja di Bandung: Factory Outlet dan Distro Terbaik',
                'slug' => 'belanja-di-bandung-factory-outlet-dan-distro-terbaik',
                'category' => 'SHOPPING',
                'reading_time' => 6,
                'excerpt' => 'Bandung surga belanja pakaian dengan harga murah! Temukan factory outlet dan distro terbaik dengan koleksi fashion terkini dan harga terjangkau...',
                'content' => '<p>Bandung terkenal sebagai kota belanja dengan banyak factory outlet dan distro berkualitas.</p>',
                'external_link' => 'https://www.google.com/search?q=factory+outlet+distro+terbaik+bandung',
                'published_at' => now()->subDays(8),
                'is_active' => true,
            ],
            [
                'title' => 'Jalan-Jalan Malam di Bandung: Tempat Wisata Malam Terbaik',
                'slug' => 'jalan-jalan-malam-di-bandung-tempat-wisata-malam-terbaik',
                'category' => 'WISATA ALAM',
                'reading_time' => 5,
                'excerpt' => 'Bandung tetap menarik di malam hari! Jelajahi tempat wisata malam terbaik dari Braga Street hingga Punclut dengan pemandangan kota yang memukau...',
                'content' => '<p>Bandung menawarkan berbagai pilihan wisata malam yang menarik untuk dikunjungi.</p>',
                'external_link' => 'https://www.google.com/search?q=wisata+malam+bandung+tempat+terbaik',
                'published_at' => now()->subDays(9),
                'is_active' => true,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
