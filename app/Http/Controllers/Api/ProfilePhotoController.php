<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan file ke storage/app/public/profile_photos
        $file = $request->file('photo');
        $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile_photos', $filename, 'public');
        $user->photo = $path;
        $user->save();

        // Kembalikan photo_url
        return response()->json([
            'photo_url' => $user->photo_url,
            'message' => 'Foto profil berhasil diupdate.'
        ]);
    }
}