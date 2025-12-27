<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Package;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);
        $user = auth()->user();
        $favorite = Favorite::firstOrCreate([
            'user_id' => $user->id,
            'package_id' => $request->package_id,
        ]);
        return response()->json(['success' => true, 'favorite_id' => $favorite->id]);
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->user();
        $favorite = Favorite::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $favorite->delete();
        return response()->json(['success' => true]);
    }
}
