<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManualPackagesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Barusan Hills',
                'slug' => 'barusan-hills',
                'excerpt' => 'Barusen Hills Ciwidey adalah sebuah tempat wisata yang terletak di kawasan Ciwidey, dekat Lembang.',
                'description' => 'Tempat ini dikenal dengan pemandangan alam yang indah dan suasana yang tenang, menjadikannya pilihan populer untuk berlibur. Barusen Hills menawarkan berbagai fasilitas seperti spot foto menarik, area bermain anak, dan jalur trekking yang memungkinkan pengunjung menikmati keindahan alam sekitar.\n\nFasilitas\nAkomodasi Hotel Bintang 4\nTransportasi selama tour\nTour guide berpengalaman\nAsuransi perjalanan',
                'duration' => '2 Hari 2 Malam',
                'price' => 2000000,
                'cover_image' => 'packages/qQK4KfWSyIb6YpHV5hSdq31syVnHNhzNSMPpYmJI.jpg',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:19:08',
                'updated_at' => '2025-12-26 20:19:08',
                'itinerary' => null,
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'title' => 'ciwidey valley',
                'slug' => 'ciwidey-valley',
                'excerpt' => 'Destinasi liburan yang sempurna bagi pecinta olahraga di Bandung, Indonesia.Ciwidey Valley Hot Spring Waterpark Resort adalah resor yang menawarkan pengalaman relaksasi dengan pemandian air panas alami.',
                'description' => 'Dikenal karena kolam renangnya yang luas dan fasilitas spa, resor ini menjadi tempat ideal untuk bersantai sambil menikmati keindahan alam Ciwidey. Pengunjung dapat menikmati berbagai aktivitas seperti berendam di kolam air panas sambil dikelilingi oleh pemandangan pegunungan yang hijau. Resor ini juga menyediakan akomodasi nyaman bagi keluarga dan pasangan yang ingin menghabiskan waktu berkualitas bersama.\n\nFasilitas\nAkomodasi Hotel Bintang 4\nTransportasi selama tour\nTour guide berpengalaman\nAsuransi perjalanan',
                'duration' => '3 Hari 3 Malam',
                'price' => 2000000,
                'cover_image' => 'packages/AFKtc14x4OKHCghbm9jFqG5IklT5MYBXReZtrGlQ.jpg',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:40:00',
                'updated_at' => '2025-12-26 20:40:00',
                'itinerary' => null,
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'title' => 'Tafso Barn',
                'slug' => 'tafso-barn',
                'excerpt' => 'Tafso Barn adalah sebuah restoran dan kafe yang terletak di Pagerwangi, Lembang, Bandung Barat.',
                'description' => 'Didirikan pada tahun 2016, tempat ini awalnya dibangun sebagai area bermain mini golf yang juga menyajikan berbagai makanan dan minuman. Seiring waktu, Tafso Barn menjadi terkenal karena konsepnya yang kekinian dan suasana yang sangat instagramable, menarik banyak pengunjung untuk berswafoto dan menikmati pemandangan alam yang indah.\n\nFasilitas\nAkomodasi Hotel Bintang 4\nTransportasi selama tour\nTour guide berpengalaman\nAsuransi perjalanan',
                'duration' => '3 Hari 3 Malam',
                'price' => 1000000,
                'cover_image' => 'packages/y663dPwT87KuyCTJLqgC0tnvppPnqzM56F2K5EcM.jpg',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:41:01',
                'updated_at' => '2025-12-26 20:41:01',
                'itinerary' => null,
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'title' => 'Orchid Forest',
                'slug' => 'orchid-forest',
                'excerpt' => 'Terletak di Cikole, Lembang, Kabupaten Bandung Barat, Jawa Barat,orchid forest cikole adalah hutan anggrek terbesar di Indonesia.',
                'description' => 'Enggak main-main, jumlah anggrek di sini mencapai 20.000 tanaman! Selain anggrek, barisan pohon pinus yang ada di sana juga membuat pemandangan Orchid Forest Cikole menjadi sangat indah. Selain menawarkan pemandangan hutan pinus dan anggrek, Orchid Forest Cikole juga memiliki tempat bermain golf, area bermain dengan kelinci, jembatan tali yang bersinar di malam hari, sampai horse ranch.\n\nFasilitas\nAkomodasi Hotel Bintang 4\nTransportasi selama tour\nTour guide berpengalaman\nAsuransi perjalanan',
                'duration' => '1 Hari 2 Malam',
                'price' => 1000000,
                'cover_image' => 'packages/6cfgy0iyuzt42PP8Fyn9QMEbXi4lgjrLxzkxnr8x.jpg',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:42:06',
                'updated_at' => '2025-12-26 20:42:06',
                'itinerary' => null,
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'title' => 'kampung cai ranva upas',
                'slug' => 'kampung-cai-ranva-upas',
                'excerpt' => 'Jika ingin ke luar kota Bandung, Ciwidey adalah area yang wajib kamu kunjungi!',
                'description' => 'Salah satu tempat wisata paling menarik di Ciwidey adalah Kampung Cai Ranca Upas. Selain punya area perkemahan yang cantik, Kampung Cai Ranca Upas juga punya Penangkaran Rusa yang menyenangkan untuk dikunjungi. Selain itu juga ada berbagai permainan outbound yang bisa kamu coba di sana bersama keluarga. Eh, di sini ada kolam pemandian air panas alaminya juga, lho!\n\nFasilitas\nAkomodasi Hotel Bintang 4\nTransportasi selama tour\nTour guide berpengalaman\nAsuransi perjalanan',
                'duration' => '1 Hari 2 Malam',
                'price' => 1300000,
                'cover_image' => 'packages/4k6A1x4rRypRTxTwArubOE6bgqGkWIZrJ7FeCAZg.webp',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:43:50',
                'updated_at' => '2025-12-26 20:43:50',
                'itinerary' => null,
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'title' => 'the lodge maribaya',
                'slug' => 'the-lodge-maribaya',
                'excerpt' => 'Objek wisata di Lembang tengah berkembang banget selama beberapa tahun belakangan, dan The Lodge Maribaya adalah salah satu destinasi wisata di Lembang yang mencuat dan menjadi populer.',
                'description' => 'Dengan wajah baru sejak 2016 lalu, The Lodge Maribaya menawarkan tempat wisata di Bandung yang ideal bagi keluarga yang menginginkan liburan unik. Selain area camp di mana pengunjung bisa menginap di dalam tenda unik, The Lodge Maribaya juga menawarkan wahana yang menarik seperti Sky Tree, Gantole, Zip Bike, dan Mountain Swing.\n\nFasilitas\nAkomodasi Hotel Bintang 4\nTransportasi selama tour\nTour guide berpengalaman\nAsuransi perjalanan',
                'duration' => '2 Hari 2 Malam',
                'price' => 1400000,
                'cover_image' => 'packages/X0A9FjDX6hfUDLPEd9eHxQeXXTi5S4qazoOXvh5n.jpg',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:45:05',
                'updated_at' => '2025-12-26 20:45:05',
                'itinerary' => null,
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'title' => 'Tebing Karaton',
                'slug' => 'tebing-karaton',
                'excerpt' => 'Paket wisata Tebing Karaton, Bandung',
                'description' => 'Nikmati sunrise dan pemandangan hutan dari Tebing Karaton.',
                'duration' => '2 Hari 2 Malam',
                'price' => 900000,
                'cover_image' => 'packages/z9284nYL4MusiAvSNXem7wiIa6rAlVSCFkx46drb.webp',
                'featured' => 1,
                'is_active' => 1,
                'created_at' => '2025-12-26 20:46:47',
                'updated_at' => '2025-12-26 21:25:43',
                'itinerary' => '["Hari 1: Penjemputan, city tour, Tebing Karaton sunrise","Hari 2: Wisata alam, kuliner, pulang"]',
            ],
        ];
        foreach ($data as $row) {
            if (!DB::table('packages')->where('id', $row['id'])->exists()) {
                DB::table('packages')->insert($row);
            }
        }
    }
}
