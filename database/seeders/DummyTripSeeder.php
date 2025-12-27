<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummyTripSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user dummy jika belum ada
        $user = \App\Models\User::firstOrCreate([
            'email' => 'dummyuser@example.com',
        ], [
            'name' => 'Dummy User',
            'password' => Hash::make('password123'),
            'is_admin' => false,
        ]);

        // Buat paket dummy jika belum ada
        $package = \App\Models\Package::firstOrCreate([
            'slug' => 'dummy-trip',
        ], [
            'user_id' => $user->id,
            'title' => 'Dummy Trip',
            'excerpt' => 'Trip dummy untuk testing',
            'description' => 'Deskripsi trip dummy. Fasilitas: Hotel, Transportasi, Guide',
            'duration' => '1 Hari 1 Malam',
            'price' => 123456,
            'cover_image' => null,
            'featured' => false,
            'is_active' => true,
            'itinerary' => ['Hari 1: Check-in, wisata, makan malam'],
        ]);

        // Buat payment dummy
        $payment = \App\Models\Payment::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'amount' => 123456,
            'status' => 'paid',
            'payment_method' => 'manual',
            'provider' => 'bank',
            'transaction_id' => 'DUMMY123',
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => '08123456789',
            'participants' => 1,
            'travel_date' => now(),
            'requests' => 'No special requests',
        ]);

        // Buat testimonial dummy terkait payment dan paket
        \App\Models\Testimonial::create([
            'name' => $user->name,
            'email' => $user->email,
            'message' => 'Trip dummy sangat menyenangkan! Admin bisa lihat ini di dashboard.',
            'approved' => true,
            'user_id' => $user->id,
            'payment_id' => $payment->id,
            'rating' => 5,
            'photo' => null,
        ]);
    }
}
