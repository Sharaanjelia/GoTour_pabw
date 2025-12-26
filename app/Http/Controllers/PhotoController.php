<?php

namespace App\Http\Controllers;

use App\Models\PhotoRecommendation;

class PhotoController extends Controller
{
    public function index()
    {
        $items = PhotoRecommendation::where('is_active', true)->orderByDesc('created_at')->paginate(12);
        return view('photos', compact('items'));
    }
}
