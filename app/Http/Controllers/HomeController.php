<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // If the page is visited with a search query (q) or duration filter,
        // reuse the same Package search logic as the Paket page and show
        // results on the home view.
        $q = $request->input('q');
        $duration = $request->input('duration');

        if ($q || $duration) {
            $query = Package::query()->where('is_active', true)->orderByDesc('featured')->orderByDesc('created_at');

            if ($q) {
                $query->where(function($sub) use ($q) {
                    $sub->where('title', 'like', "%$q%")
                        ->orWhere('excerpt', 'like', "%$q%")
                        ->orWhere('description', 'like', "%$q%");
                });
            }

            if ($duration && $duration !== 'all') {
                $query->where('duration', 'like', "%$duration%");
            }

            $packages = $query->paginate(12)->withQueryString();

            return view('home', compact('packages'));
        }

        return view('home'); // memanggil resources/views/home.blade.php
    }
}
