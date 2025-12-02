@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@push('styles')
<style>
    .admin-form-container {
        max-width: 800px;
        margin: 2rem auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }
    .admin-form-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }
    .admin-form-group {
        margin-bottom: 1.5rem;
    }
    .admin-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .admin-form-input,
    .admin-form-select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .admin-form-input:focus,
    .admin-form-select:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .info-box {
        background: #f3f4f6;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }
    .info-box h3 {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.75rem;
    }
    .info-box p {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0.25rem 0;
    }
    .admin-form-button {
        padding: 0.75rem 2rem;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .admin-form-button:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .btn-back {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: #6b7280;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 1rem;
    }
    .btn-back:hover {
        background: #4b5563;
    }
</style>
@endpush

@section('content')
<div class="admin-form-container">
    <h2 class="admin-form-title">Edit Pembayaran</h2>
    
    <div class="info-box">
        <h3>Informasi Booking</h3>
        <p><strong>Customer:</strong> {{ $payment->full_name }} ({{ $payment->email }})</p>
        <p><strong>Paket:</strong> {{ $payment->package->title ?? '-' }}</p>
        <p><strong>Tanggal Perjalanan:</strong> {{ $payment->travel_date ? \Carbon\Carbon::parse($payment->travel_date)->format('d M Y') : '-' }}</p>
        <p><strong>Jumlah Peserta:</strong> {{ $payment->participants ?? 0 }} orang</p>
        <p><strong>Total:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
    </div>

    <form method="POST" action="{{ route('admin.payments-admin.update', $payment) }}">
        @csrf
        @method('PUT')

        <div class="admin-form-group">
            <label class="admin-form-label">Status Pembayaran *</label>
            <select name="status" class="admin-form-select" required>
                <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ old('status', $payment->status) == 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                <option value="cancelled" {{ old('status', $payment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                <option value="refunded" {{ old('status', $payment->status) == 'refunded' ? 'selected' : '' }}>Refunded (Dikembalikan)</option>
            </select>
        </div>

        <div class="form-row">
            <div class="admin-form-group">
                <label class="admin-form-label">Metode Pembayaran</label>
                <input type="text" name="payment_method" value="{{ old('payment_method', $payment->payment_method) }}" class="admin-form-input" placeholder="transfer, ewallet, card">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Provider</label>
                <input type="text" name="provider" value="{{ old('provider', $payment->provider) }}" class="admin-form-input" placeholder="BCA, Mandiri, GoPay, dll">
            </div>
        </div>

        <div class="admin-form-group">
            <label class="admin-form-label">Transaction ID</label>
            <input type="text" name="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}" class="admin-form-input" placeholder="TRX-XXXXXX">
        </div>

        <div style="margin-top: 2rem;">
            <a href="{{ route('admin.payments-admin.index') }}" class="btn-back">Kembali</a>
            <button type="submit" class="admin-form-button">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
