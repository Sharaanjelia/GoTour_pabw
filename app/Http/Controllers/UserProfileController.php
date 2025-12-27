<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // E-Tiket: pembayaran sukses
        $tickets = $user->payments()
            ->where('status', 'paid')
            ->with('package')
            ->orderByDesc('created_at')
            ->get();

        // Riwayat Trip: pembayaran selesai
        $trips = $user->payments()
            ->where('status', 'done')
            ->with('package')
            ->orderByDesc('travel_date')
            ->get();

        // Testimoni: testimoni milik user
        $testimonials = $user->hasMany(\App\Models\Testimonial::class)
            ->with('payment.package')
            ->orderByDesc('created_at')
            ->get();

        // Favorit: destinasi yang disimpan user
        $favorites = $user->favorites()->with('package')->get();

        return view('profile.index', compact('user', 'tickets', 'trips', 'testimonials', 'favorites'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = auth()->user();
        
        auth()->logout();
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun berhasil dihapus!');
    }
}
