<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoRecommendation;

class PhotoRecommendationAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->is_admin) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return $next($request);
        });
    }

    public function index() { return PhotoRecommendation::all(); }
    public function show($id) { return PhotoRecommendation::findOrFail($id); }
    public function store(Request $request) { return PhotoRecommendation::create($request->all()); }
    public function update(Request $request, $id) {
        $rec = PhotoRecommendation::findOrFail($id);
        $rec->update($request->all());
        return $rec;
    }
    public function destroy($id) {
        $rec = PhotoRecommendation::findOrFail($id);
        $rec->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
