<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['user', 'package'])
            ->orderByDesc('created_at');
        
        if ($search = $request->input('q')) {
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('transaction_id', 'like', "%$search%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }
        
        $bookings = $query->paginate(20)->withQueryString();
        
        return view('admin.bookings.index', compact('bookings'));
    }

    public function edit(Payment $booking)
    {
        $booking->load(['user', 'package']);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Payment $booking)
    {
        $data = $request->validate([
            'travel_date' => 'required|date',
            'participants' => 'required|integer|min:1',
            'amount' => 'required|integer|min:0',
            'status' => 'required|in:pending,paid,cancelled,refunded',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'requests' => 'nullable|string',
            'payment_method' => 'nullable|string|max:50',
            'provider' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $booking->update($data);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diupdate');
    }

    public function destroy(Payment $booking)
    {
        $booking->delete();
        
        return back()->with('success', 'Booking berhasil dihapus');
    }
}
