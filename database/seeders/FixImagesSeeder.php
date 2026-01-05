<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\PhotoRecommendation;
use App\Models\Service;
use App\Models\Testimonial;

class FixImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Update Packages dengan gambar dari public/images
        $packages = [
            ['id' => 1, 'cover_image' => 'packages/kawah putih ciwidey.webp'],
            ['id' => 2, 'cover_image' => 'packages/Tebing karaton.webp'],
            ['id' => 3, 'cover_image' => 'packages/Dusun Bambu Lembang.webp'],
            ['id' => 4, 'cover_image' => 'packages/orchid forest cikole.jpg'],
            ['id' => 5, 'cover_image' => 'packages/Farmhouse Lembang.webp'],
        ];

        foreach ($packages as $data) {
            Package::where('id', $data['id'])->update(['cover_image' => $data['cover_image']]);
        }

        // Update PhotoRecommendations
        PhotoRecommendation::where('id', 1)->update(['image' => 'photos/gya fto 2.avif']);
        PhotoRecommendation::where('id', 2)->update(['image' => 'photos/gya fto.4.jpg']);
        PhotoRecommendation::where('id', 3)->update(['image' => 'photos/gya fto 3.avif']);
        PhotoRecommendation::where('id', 4)->update(['image' => 'photos/gya fto 14.jpg']);
        PhotoRecommendation::where('id', 5)->update(['image' => 'photos/gya fto 5.jpg']);
        PhotoRecommendation::where('id', 6)->update(['image' => 'photos/gya fto 6.jpg']);
        PhotoRecommendation::where('id', 7)->update(['image' => 'photos/gya fto 7.jpg']);
        PhotoRecommendation::where('id', 8)->update(['image' => 'photos/gya fto 16.jpg']);
        PhotoRecommendation::where('id', 9)->update(['image' => 'photos/gya fto 10.jpg']);
        PhotoRecommendation::where('id', 10)->update(['image' => 'photos/gya fto 11.jpg']);
        PhotoRecommendation::where('id', 11)->update(['image' => 'photos/gya foto 12.jpg']);
        PhotoRecommendation::where('id', 12)->update(['image' => 'photos/gya foto 9.jpg']);

        // Update Services
        $services = [
            ['id' => 1, 'image' => 'services/akomodasi.jpeg'],
            ['id' => 2, 'image' => 'services/transportasi.jpeg'],
            ['id' => 3, 'image' => 'services/paket makan.jpeg'],
            ['id' => 4, 'image' => 'services/informasi wisata.jpg'],
            ['id' => 5, 'image' => 'services/layanan 24jam.webp'],
            ['id' => 6, 'image' => 'services/paket kostum.jpeg'],
        ];

        foreach ($services as $data) {
            Service::where('id', $data['id'])->update(['image' => $data['image']]);
        }

        // Update Testimonials
        $testimonials = [
            ['id' => 1, 'photo' => 'testimonials/fotoshara.jpg'],
            ['id' => 2, 'photo' => 'testimonials/Fataya.jpg'],
            ['id' => 3, 'photo' => 'testimonials/fotokhai.jpg'],
            ['id' => 4, 'photo' => 'testimonials/foto orchid.jpeg'],
            ['id' => 5, 'photo' => 'testimonials/foto hana.jpeg'],
            ['id' => 6, 'photo' => 'testimonials/foto lina.jpeg'],
            ['id' => 7, 'photo' => 'testimonials/foto tizy.jpeg'],
            ['id' => 8, 'photo' => 'testimonials/foto cowok.jpg'],
        ];

        foreach ($testimonials as $data) {
            Testimonial::where('id', $data['id'])->update(['photo' => $data['photo']]);
        }

        $this->command->info('✅ Semua gambar berhasil diupdate!');
    }
}
