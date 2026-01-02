<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        return response()->json(
            Testimonial::all()->map(function($testimonial) {
                $data = $testimonial->toArray();
                $data['photo_url'] = $testimonial->photo_url;
                return $data;
            })
        );
    }
}
