<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $q = BlogPost::where('is_active', true)->orderByDesc('published_at');
        if ($s = $request->input('q')) $q->where('title','like',"%$s%");
        $posts = $q->paginate(12)->withQueryString();
        return view('blog', compact('posts'));
    }

    public function show(BlogPost $blog)
    {
        if (!$blog->is_active) {
            abort(404);
        }
        return view('blog.show', compact('blog'));
    }
}
