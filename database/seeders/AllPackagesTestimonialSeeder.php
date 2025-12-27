<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AllPackagesTestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $imageFiles = [
            'shara.jpg',
            'khairunnisa.jpg',
            'Fataya.jpg',
            'foto hana.jpeg',
            'foto lina.jpeg',
            'foto tizy.jpeg',
            'fotoaqila.jpg',
            'fotokhai.jpg',
            'fotoshara.jpg',
            'foto cowok.jpg',
            'foto pemandu wisata.png',
        ];
        $users = \App\Models\User::where('is_admin', false)->get();
        $userCount = $users->count();
        $imageCount = count($imageFiles);
        foreach (\App\Models\Package::all() as $package) {
            $uniqueMessages = [
                'Trip ke ' . $package->title . ' sangat menyenangkan, pemandu ramah!',
                'Fasilitas di ' . $package->title . ' lengkap dan perjalanan lancar.',
                'Saya sangat merekomendasikan paket ' . $package->title . ' untuk liburan keluarga!',
            ];
            for ($idx = 0; $idx < 3; $idx++) {
                $user = $users[($package->id + $idx) % $userCount];
                $payment = \App\Models\Payment::create([
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'amount' => $package->price ?? 100000,
                    'status' => 'paid',
                    'payment_method' => 'manual',
                    'provider' => 'bank',
                    'transaction_id' => 'PKG' . $package->id . rand(100,999) . $idx,
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'phone' => '08123456789',
                    'participants' => 1,
                    'travel_date' => now(),
                    'requests' => 'No special requests',
                ]);
                \App\Models\Testimonial::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'message' => $uniqueMessages[$idx],
                    'approved' => true,
                    'user_id' => $user->id,
                    'payment_id' => $payment->id,
                    'rating' => rand(4,5),
                    'photo' => 'images/' . $imageFiles[($package->id + $idx) % $imageCount],
                ]);
            }
        }
    }
}
