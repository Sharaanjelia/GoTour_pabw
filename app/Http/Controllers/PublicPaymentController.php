<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Package;
use Illuminate\Http\Request;

class PublicPaymentController extends Controller
{
    public function store(Request $request)
    {
        // require login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'amount' => 'required|integer|min:0',
            'payment_method' => 'required|string|max:100',
        ]);

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'package_id' => $data['package_id'],
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'status' => 'pending',
        ]);

        // in a real app we'd hand off to payment gateway; for now show a simple thank you
        return redirect()->route('paket.index')->with('success', 'Pembayaran dicatat (simulasi).');
    }
}
