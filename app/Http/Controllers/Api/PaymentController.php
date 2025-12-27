<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json(Payment::where('user_id', $user->id)->get());
    }

    public function show($id)
    {
        $user = Auth::user();
        $payment = Payment::where('user_id', $user->id)->find($id);
        if (!$payment) return response()->json(['error' => 'Not found'], 404);
        return response()->json($payment);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'amount' => 'required|numeric',
            'status' => 'required',
            'payment_method' => 'required',
            'transaction_id' => 'nullable',
        ]);
        $data['user_id'] = $user->id;
        $payment = Payment::create($data);
        return response()->json($payment, 201);
    }
}
