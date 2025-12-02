<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $q = BlogPost::query()->orderByDesc('created_at');
        if ($s = $request->input('q')) {
            $q->where('title', 'like', "%$s%")->orWhere('excerpt', 'like', "%$s%");
        }
        $posts = $q->paginate(15)->withQueryString();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = auth()->id();
        $data['is_active'] = $request->has('is_active');

        $base = $data['slug']; $i = 1;
        while (BlogPost::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i++;
        }

        BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Post dibuat');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', ['post' => $blog]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($old = $blog->cover_image) {
                if (str_starts_with($old, 'storage/')) {
                    $old = substr($old, strlen('storage/'));
                }
                Storage::disk('public')->delete($old);
            }
            $data['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        if ($data['title'] !== $blog->title) {
            $slug = Str::slug($data['title']); $base = $slug; $i = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        $blog->update($data);
        return redirect()->route('admin.blog.index')->with('success', 'Post diperbarui');
    }

    public function show(BlogPost $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function destroy(BlogPost $blog)
    {
        if ($old = $blog->cover_image) {
            if (str_starts_with($old, 'storage/')) {
                $old = substr($old, strlen('storage/'));
            }
            Storage::disk('public')->delete($old);
        }
        $blog->delete();
        return back()->with('success', 'Post dihapus');
    }
}
