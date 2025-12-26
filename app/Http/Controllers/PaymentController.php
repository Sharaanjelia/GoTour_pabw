<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Package;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $payments = Payment::with('package')
                ->where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->paginate(20);
        } else {
            $payments = collect(); 
        }
        
        return view('payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $package = null;
        
        if ($request->has('package_id')) {
            $package = Package::find($request->package_id);
        }
        
        $packages = Package::where('is_active', true)->get();
        
        return view('payments.create', compact('packages', 'package'));
    }

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
            'user_id' => auth()->id(), 
            'package_id' => $data['package_id'],
            'amount' => $data['amount'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'participants' => $data['participants'] ?? 1,
            'travel_date' => $data['travel_date'] ?? null,
            'requests' => $data['requests'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.methods', $payment)
            ->with('success', 'Booking created! Please choose a payment method.');
    }

    public function show(Payment $payment)
    {
        $payment->load('package');

        if (auth()->check() && $payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
 
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $packages = Package::where('is_active', true)->get();
        
        return view('payments.edit', compact('payment', 'packages'));
    }

    public function update(Request $request, Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
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

        return redirect()->route('payments.show', $payment)
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    public function methods(Payment $payment)
    {
        $payment->load('package');
        
        return view('payments.methods', compact('payment'));
    }

    public function pay(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'payment_method' => 'required|string|in:bank_transfer,credit_card,e_wallet,cash',
        ]);

        $provider = null;
        if ($data['payment_method'] === 'bank_transfer') {
            $provider = $request->input('bank_provider');
        } elseif ($data['payment_method'] === 'e_wallet') {
            $provider = $request->input('ewallet_provider');
        } elseif ($data['payment_method'] === 'credit_card') {
            $provider = $request->input('card_provider');
        }

        $payment->update([
            'payment_method' => $data['payment_method'],
            'provider' => $provider,
            'status' => 'paid', 
            'transaction_id' => 'TRX' . strtoupper(uniqid()),
        ]);

        return redirect()->route('payments.success', $payment);
    }

    public function success(Payment $payment)
    {
        $payment->load('package');
        
        return view('payments.success', compact('payment'));
    }
}
