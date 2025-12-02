<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoRecommendation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PhotoRecommendationController extends Controller
{
    public function index()
    {
        $items = PhotoRecommendation::orderByDesc('created_at')->paginate(20);
        return view('admin.photos.index', compact('items'));
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('photos', 'public');
        }

        PhotoRecommendation::create($data);
        return redirect()->route('admin.photos.index')->with('success','Saved');
    }

    public function edit(PhotoRecommendation $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, PhotoRecommendation $photo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            if ($old = $photo->image) {
                if (str_starts_with($old, 'storage/')) {
                    $old = substr($old, strlen('storage/'));
                }
                Storage::disk('public')->delete($old);
            }
            $data['image'] = $request->file('image')->store('photos', 'public');
        }

        $photo->update($data);
        return redirect()->route('admin.photos.index')->with('success','Updated');
    }

    public function destroy(PhotoRecommendation $photo)
    {
        if ($old = $photo->image) {
            if (str_starts_with($old, 'storage/')) {
                $old = substr($old, strlen('storage/'));
            }
            Storage::disk('public')->delete($old);
        }
        $photo->delete();
        return back()->with('success','Deleted');
    }
}
