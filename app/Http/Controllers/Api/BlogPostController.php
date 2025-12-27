<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
        return response()->json(BlogPost::all());
    }

    public function show($id)
    {
        $blog = BlogPost::find($id);
        if (!$blog) return response()->json(['error' => 'Not found'], 404);
        return response()->json($blog);
    }
}
