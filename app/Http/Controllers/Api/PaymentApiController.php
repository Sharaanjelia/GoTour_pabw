<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Package;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{
    // GET /api/payments
    public function index(Request $request)
    {
        $payments = Payment::with('package')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json($payments);
    }

    // POST /api/payments
    public function store(Request $request)
    {
        $data = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'amount' => 'required|integer|min:0',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'participants' => 'nullable|integer|min:1',
            'travel_date' => 'nullable|date',
            'requests' => 'nullable|string|max:1000',
        ]);

        $payment = Payment::create([
            'user_id' => $request->user()->id,
            'status' => 'pending',
            ...$data
        ]);

        return response()->json([
            'message' => 'Payment created successfully',
            'data' => $payment->load('package')
        ], 201);
    }

    // GET /api/payments/{payment}
    public function show(Request $request, Payment $payment)
    {
        if ($payment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($payment->load('package'));
    }

    // PUT /api/payments/{payment}
    public function update(Request $request, Payment $payment)
    {
        if ($payment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'amount' => 'required|integer|min:0',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'participants' => 'nullable|integer|min:1',
            'travel_date' => 'nullable|date',
            'requests' => 'nullable|string|max:1000',
        ]);

        $payment->update($data);

        return response()->json([
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    // DELETE /api/payments/{payment}
    public function destroy(Request $request, Payment $payment)
    {
        if ($payment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }

    // POST /api/payments/{payment}/pay
    public function pay(Request $request, Payment $payment)
    {
        if ($payment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet,cash',
            'provider' => 'nullable|string|max:100',
        ]);

        $payment->update([
            'payment_method' => $data['payment_method'],
            'provider' => $data['provider'] ?? null,
            'status' => 'paid',
            'transaction_id' => 'TRX' . strtoupper(uniqid()),
        ]);

        return response()->json([
            'message' => 'Payment success',
            'data' => $payment
        ]);
    }
}
