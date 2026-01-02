<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialAdminController extends Controller
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

    public function index() { return Testimonial::all(); }
    public function show($id) { return Testimonial::findOrFail($id); }
    public function store(Request $request) { return Testimonial::create($request->all()); }
    public function update(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->all());
        return $testimonial;
    }
    public function destroy($id) {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
