<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
    /**
     * GET /api/blog-posts
     * List blog (search + pagination)
     */
    public function index(Request $request)
    {
        $query = BlogPost::where('is_active', true)
            ->orderByDesc('published_at');

        // search ?q=keyword
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $posts = $query->paginate(12)->withQueryString();

        return response()->json($posts);
    }

    /**
     * GET /api/blog-posts/{id}
     * Detail blog
     */
    public function show(BlogPost $blog)
    {
        if (!$blog->is_active) {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }

        return response()->json($blog);
    }
}
