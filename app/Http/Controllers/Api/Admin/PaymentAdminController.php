<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->is_admin) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return $next($request);
        });
    }

    public function index() { return Payment::all(); }
    public function show($id) { return Payment::findOrFail($id); }
    public function store(Request $request) { return Payment::create($request->all()); }
    public function update(Request $request, $id) {
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return $payment;
    }
    public function destroy($id) {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
