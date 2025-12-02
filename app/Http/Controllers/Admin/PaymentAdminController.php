<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['user', 'package'])
            ->orderByDesc('created_at');
        
        if ($search = $request->input('q')) {
            $query->where(function($q) use ($search) {
                $q->where('transaction_id', 'like', "%$search%")
                  ->orWhere('full_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }
        
        $payments = $query->paginate(20)->withQueryString();
        
        return view('admin.payments.index', compact('payments'));
    }

    public function edit(Payment $payment)
    {
        $payment->load(['user', 'package']);
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,paid,cancelled,refunded',
            'payment_method' => 'nullable|string|max:50',
            'provider' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $payment->update($data);

        return redirect()
            ->route('admin.payments-admin.index')
            ->with('success', 'Status pembayaran berhasil diupdate');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        
        return back()->with('success', 'Pembayaran berhasil dihapus');
    }
}
