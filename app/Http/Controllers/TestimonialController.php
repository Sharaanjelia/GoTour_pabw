<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $items = Testimonial::where('approved', true)->orderByDesc('created_at')->paginate(12);
        return view('testimonials', compact('items'));
    }

    public function store(Request $request)
    {
        // Jika dari e-tiket (payment)
        if ($request->has('payment_id')) {
            $data = $request->validate([
                'payment_id' => 'required|exists:payments,id',
                'content' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
            ]);
            $payment = \App\Models\Payment::findOrFail($data['payment_id']);
            // Cegah duplikat testimoni untuk payment yang sama
            if ($payment->testimonial) {
                return back()->with('error', 'Testimoni untuk transaksi ini sudah ada.');
            }
            $testimonial = Testimonial::create([
                'user_id' => $payment->user_id ?? auth()->id(),
                'payment_id' => $payment->id,
                'name' => $payment->full_name ?? auth()->user()->name ?? 'User',
                'email' => $payment->email ?? null,
                'message' => $data['content'],
                'rating' => $data['rating'],
                'approved' => false,
            ]);
            return back()->with('success', 'Terima kasih, testimoni Anda akan ditinjau.');
        }
        // Testimoni umum (bukan dari e-tiket)
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);
        $data['approved'] = false;
        if (auth()->check()) $data['user_id'] = auth()->id();
        Testimonial::create($data);
        return back()->with('success', 'Terima kasih — testimoni Anda akan ditinjau.');
    }
}
