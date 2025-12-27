<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Testimonial;

class ProfileDummySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            echo "User tidak ditemukan!\n";
            return;
        }

        $packages = Package::take(3)->get();

        if ($packages->count() < 3) {
            echo "Package tidak cukup!\n";
            return;
        }

        // Buat 3 payments untuk E-Tiket
        $paymentMethods = ['bank_transfer', 'e-wallet', 'credit_card'];
        $providers = ['BCA', 'GoPay', 'Visa'];
        
        foreach ($packages as $index => $package) {
            Payment::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'amount' => $package->price * ($index + 2),
                'status' => 'paid',
                'payment_method' => $paymentMethods[$index],
                'provider' => $providers[$index],
                'transaction_id' => 'TRX' . time() . rand(100, 999) . $index,
                'full_name' => $user->name,
                'email' => $user->email,
                'phone' => '081234567890',
                'participants' => $index + 2,
                'travel_date' => now()->addDays(($index + 1) * 7),
                'requests' => 'Mohon sediakan guide berbahasa Inggris dan dokumentasi foto'
            ]);
        }

        // Buat 3 testimonials
        $testimonials = [
            [
                'name' => $user->name,
                'email' => $user->email,
                'message' => 'Pengalaman wisata yang luar biasa! Guide sangat ramah dan profesional, destinasi wisatanya sangat indah dan instagramable. Highly recommended untuk liburan keluarga!',
                'rating' => 5
            ],
            [
                'name' => $user->name,
                'email' => $user->email,
                'message' => 'Pelayanan sangat memuaskan, itinerary terstruktur dengan baik. Harga yang ditawarkan sangat sesuai dengan fasilitas dan pengalaman yang diberikan. Pasti akan booking lagi!',
                'rating' => 5
            ],
            [
                'name' => $user->name,
                'email' => $user->email,
                'message' => 'Trip yang menyenangkan bersama keluarga. Anak-anak sangat menikmati setiap momennya, terutama aktivitas outdoor dan kuliner lokalnya. Terima kasih GoTour!',
                'rating' => 4
            ]
        ];

        foreach ($testimonials as $testi) {
            Testimonial::create($testi);
        }

        echo "Data dummy profile berhasil dibuat!\n";
        echo "- 3 E-Tiket (Payments)\n";
        echo "- 3 Testimoni\n";
    }
}
