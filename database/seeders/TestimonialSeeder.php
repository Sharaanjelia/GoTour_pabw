<?php
// Seeder dinonaktifkan. Data diambil dari SQL dump, tidak perlu insert apapun di sini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Seeder dinonaktifkan, gunakan SQL dump untuk data.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Shara',
                'message' => 'Pengalaman yang luar biasa! Pemandu sangat ramah dan membantu.',
                'approved' => true,
            ],
            [
                'name' => 'Khairunnisa',
                'message' => 'Paket wisata yang sangat terjangkau dan menyenangkan!',
                'approved' => true,
            ],
            [
                'name' => 'Fataya',
                'message' => 'Saya sangat merekomendasikan GoTour untuk semua orang!',
                'approved' => true,
            ],
            [
                'name' => 'Hana',
                'message' => 'Gotour memiliki fitur pencarian yang sangat efisien, membuat saya mudah menemukan apa yang saya butuhkan',
                'approved' => true,
            ],
            [
                'name' => 'Yaya',
                'message' => 'Saya suka bagaimana Gotour menyediakan ulasan dari pelanggan sebelumnya, ini membantu saya dalam memilih paket yang tepat',
                'approved' => true,
            ],
            [
                'name' => 'Yoga',
                'message' => 'Pengalaman saya menggunakan Gotour luar biasa! Semua berjalan sesuai rencana tanpa kendala',
                'approved' => true,
            ],
            [
                'name' => 'Tizy',
                'message' => 'Informasi yang disediakan di website Gotour sangat lengkap dan jelas, memudahkan saya dalam merencanakan perjalanan',
                'approved' => true,
            ],
            [
                'name' => 'Lina',
                'message' => 'Saya sangat terkesan dengan pilihan destinasi yang ditawarkan oleh Gotour. Sangat beragam dan menarik!',
                'approved' => true,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Testimonial::create($item);
        }
    }
}
