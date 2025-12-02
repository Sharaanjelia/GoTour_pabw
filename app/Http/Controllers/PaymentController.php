<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Package;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments (user's own payments if authenticated).
     */
    public function index()
    {
        if (auth()->check()) {
            $payments = Payment::with('package')
                ->where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->paginate(20);
        } else {
            $payments = collect(); // empty collection for guests
        }
        
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create(Request $request)
    {
        $package = null;
        
        // Allow pre-selecting a package via query string
        if ($request->has('package_id')) {
            $package = Package::find($request->package_id);
        }
        
        $packages = Package::where('is_active', true)->get();
        
        return view('payments.create', compact('packages', 'package'));
    }

    /**
     * Store a newly created payment in storage (public - allows guest booking).
     */
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

        // Create payment record (status: pending by default)
        $payment = Payment::create([
            'user_id' => auth()->id(), // null if guest
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

        // Redirect to payment method selection
        return redirect()->route('payments.methods', $payment)
            ->with('success', 'Booking created! Please choose a payment method.');
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load('package');
        
        // Only allow viewing own payments (or allow all for guests during booking flow)
        if (auth()->check() && $payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment (auth required).
     */
    public function edit(Payment $payment)
    {
        // Only allow editing own payments
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $packages = Package::where('is_active', true)->get();
        
        return view('payments.edit', compact('payment', 'packages'));
    }

    /**
     * Update the specified payment in storage (auth required).
     */
    public function update(Request $request, Payment $payment)
    {
        // Only allow updating own payments
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

    /**
     * Remove the specified payment from storage (auth required).
     */
    public function destroy(Payment $payment)
    {
        // Only allow deleting own payments
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    /**
     * Show payment method selection page.
     */
    public function methods(Payment $payment)
    {
        $payment->load('package');
        
        return view('payments.methods', compact('payment'));
    }

    /**
     * Process the payment with selected method.
     */
    public function pay(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'payment_method' => 'required|string|in:bank_transfer,credit_card,e_wallet,cash',
        ]);

        // Get provider info based on payment method
        $provider = null;
        if ($data['payment_method'] === 'bank_transfer') {
            $provider = $request->input('bank_provider');
        } elseif ($data['payment_method'] === 'e_wallet') {
            $provider = $request->input('ewallet_provider');
        } elseif ($data['payment_method'] === 'credit_card') {
            $provider = $request->input('card_provider');
        }

        // Update payment with selected method and provider
        $payment->update([
            'payment_method' => $data['payment_method'],
            'provider' => $provider,
            'status' => 'paid', // For demo purposes, mark as paid immediately
            'transaction_id' => 'TRX' . strtoupper(uniqid()),
        ]);

        // Redirect to success page with e-ticket
        return redirect()->route('payments.success', $payment);
    }

    /**
     * Show payment success page with e-ticket.
     */
    public function success(Payment $payment)
    {
        $payment->load('package');
        
        return view('payments.success', compact('payment'));
    }
}
