<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        return response()->json(Package::all());
    }

    public function show($id)
    {
        $package = Package::find($id);
        if (!$package) return response()->json(['error' => 'Not found'], 404);
        return response()->json($package);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'slug' => 'required|unique:packages',
            'excerpt' => 'nullable',
            'description' => 'nullable',
            'duration' => 'nullable',
            'price' => 'required|numeric',
            'cover_image' => 'nullable',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'itinerary' => 'nullable',
        ]);
        $package = Package::create($data);
        return response()->json($package, 201);
    }

    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        if (!$package) return response()->json(['error' => 'Not found'], 404);
        $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes',
            'slug' => 'sometimes|unique:packages,slug,' . $id,
            'excerpt' => 'nullable',
            'description' => 'nullable',
            'duration' => 'nullable',
            'price' => 'sometimes|numeric',
            'cover_image' => 'nullable',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'itinerary' => 'nullable',
        ]);
        $package->update($data);
        return response()->json($package);
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        if (!$package) return response()->json(['error' => 'Not found'], 404);
        $package->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
