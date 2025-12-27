<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostApiController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::orderByDesc('created_at');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->q}%")
                  ->orWhere('excerpt', 'like', "%{$request->q}%");
            });
        }

        return response()->json(
            $query->paginate(15)->withQueryString()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'reading_time' => 'nullable|integer|min:1|max:60',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'external_link' => 'nullable|url|max:500',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = auth()->id();
        $data['is_active'] = $request->boolean('is_active');

        $base = $data['slug']; $i = 1;
        while (BlogPost::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i++;
        }

        $post = BlogPost::create($data);

        return response()->json([
            'message' => 'Post created',
            'data' => $post
        ], 201);
    }

    public function show($id)
    {
        return response()->json(
            BlogPost::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $blog = BlogPost::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'reading_time' => 'nullable|integer|min:1|max:60',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'external_link' => 'nullable|url|max:500',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image) {
                Storage::disk('public')->delete($blog->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        if ($data['title'] !== $blog->title) {
            $slug = Str::slug($data['title']);
            $base = $slug; $i = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        $blog->update($data);

        return response()->json([
            'message' => 'Post updated',
            'data' => $blog
        ]);
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);

        if ($blog->cover_image) {
            Storage::disk('public')->delete($blog->cover_image);
        }

        $blog->delete();

        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}
