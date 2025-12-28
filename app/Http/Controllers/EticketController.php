<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EticketController extends Controller
{
    public function download($paymentId)
    {
        $user = Auth::user();
        $payment = $user->payments()->with('package')->findOrFail($paymentId);
        $pdf = Pdf::loadView('profile.eticket-pdf', compact('user', 'payment'));
        return $pdf->download('e-tiket-'.$payment->transaction_id.'.pdf');
    }
}
