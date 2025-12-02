@extends('layouts.admin')

@section('title', 'Edit Booking & Pembayaran')

@section('content')
<div class="container2 admin-tight mt-2 mb-4">
    <h1 class="text-2xl font-bold mb-3">Edit Booking & Pembayaran</h1>

    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <h3 class="text-lg font-bold mb-3" style="color: #374151;">📋 Informasi Paket</h3>
        
        <label class="form-label mb-2">Paket
            <input type="text" value="{{ $booking->package->title ?? 'N/A' }}" class="form-input" readonly style="background: #f3f4f6;">
        </label>
        <br>

        <h3 class="text-lg font-bold mb-3 mt-4" style="color: #374151;">👤 Data Customer</h3>

        <label class="form-label mb-2">Nama Lengkap
            <input type="text" name="full_name" value="{{ old('full_name', $booking->full_name) }}" class="form-input" required>
        </label>
        <br>

        <label class="form-label mb-2">Email
            <input type="email" name="email" value="{{ old('email', $booking->email) }}" class="form-input" required>
        </label>
        <br>

        <label class="form-label mb-2">No. Telepon
            <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}" class="form-input" required>
        </label>
        <br>

        <h3 class="text-lg font-bold mb-3 mt-4" style="color: #374151;">🎫 Detail Booking</h3>

        <label class="form-label mb-2">Tanggal Perjalanan
            <input type="date" name="travel_date" value="{{ old('travel_date', $booking->travel_date ? \Carbon\Carbon::parse($booking->travel_date)->format('Y-m-d') : '') }}" class="form-input">
        </label>
        <br>

        <label class="form-label mb-2">Jumlah Peserta
            <input type="number" name="participants" value="{{ old('participants', $booking->participants) }}" class="form-input" min="1">
        </label>
        <br>

        <label class="form-label mb-2">Permintaan Khusus
            <textarea name="special_requests" class="form-input" rows="3">{{ old('special_requests', $booking->special_requests) }}</textarea>
        </label>
        <br>

        <h3 class="text-lg font-bold mb-3 mt-4" style="color: #374151;">💳 Informasi Pembayaran</h3>

        <label class="form-label mb-2">Total Pembayaran
            <input type="number" name="amount" value="{{ old('amount', $booking->amount) }}" class="form-input" required>
        </label>
        <br>

        <label class="form-label mb-2">Metode Pembayaran
            <select name="payment_method" class="form-input" required>
                <option value="">Pilih Metode</option>
                <option value="transfer" {{ old('payment_method', $booking->payment_method) == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="ewallet" {{ old('payment_method', $booking->payment_method) == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                <option value="card" {{ old('payment_method', $booking->payment_method) == 'card' ? 'selected' : '' }}>Kartu Kredit/Debit</option>
            </select>
        </label>
        <br>

        <label class="form-label mb-2">Provider
            <input type="text" name="provider" value="{{ old('provider', $booking->provider) }}" class="form-input" placeholder="BCA, Mandiri, GoPay">
        </label>
        <br>

        <label class="form-label mb-2">Transaction ID
            <input type="text" name="transaction_id" value="{{ old('transaction_id', $booking->transaction_id) }}" class="form-input" placeholder="TRX-XXXXXX">
        </label>
        <br>

        <label class="form-label mb-2">Status
            <select name="status" class="form-input" required>
                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ old('status', $booking->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="refunded" {{ old('status', $booking->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
        </label>
        <br>

        <div class="mt-4">
            <button class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="{{ route('admin.bookings.index') }}" class="ml-2 text-gray-600">Kembali</a>
        </div>
    </form>
</div>
@endsection
