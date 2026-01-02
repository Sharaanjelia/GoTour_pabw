<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoRecommendation;

class PhotoRecommendationController extends Controller
{
    public function index() {
        return PhotoRecommendation::all();
    }

    public function show($id) {
        return PhotoRecommendation::findOrFail($id);
    }
}
