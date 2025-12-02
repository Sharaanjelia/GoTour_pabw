<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user','package'])->orderByDesc('created_at')->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['user','package']);
        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate(['status' => 'required|string']);
        $payment->update($data);
        return back()->with('success','Updated');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success','Deleted');
    }
}
