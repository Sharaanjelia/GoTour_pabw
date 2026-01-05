<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoRecommendation;

class PhotoRecommendationController extends Controller
{
    public function index(Request $request) 
    {
        $query = PhotoRecommendation::where('is_active', true);
        
        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        // Search by title or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tips', 'like', "%{$search}%");
            });
        }
        
        // Pagination
        $perPage = $request->get('per_page', 15);
        
        return response()->json($query->paginate($perPage));
    }

    public function show($id) 
    {
        $recommendation = PhotoRecommendation::where('is_active', true)->find($id);
        
        if (!$recommendation) {
            return response()->json(['message' => 'Photo recommendation not found'], 404);
        }
        
        return response()->json($recommendation);
    }
}
