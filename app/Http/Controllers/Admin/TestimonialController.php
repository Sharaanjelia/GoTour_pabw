<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $items = Testimonial::orderByDesc('created_at')->paginate(20);
        return view('admin.testimonials.index', compact('items'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['approved' => true]);
        return back()->with('success', 'Testimonial approved');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'approved' => 'sometimes',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimonial->photo) {
                \Storage::disk('public')->delete($testimonial->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $data['approved'] = $request->has('approved');
        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success','Testimonial updated');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success','Deleted');
    }
}
