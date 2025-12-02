@extends('layouts.admin')

@section('title', 'Kelola Booking & Pembayaran')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-3xl font-bold">Kelola Booking & Pembayaran</h1>
            <div class="text-sm text-muted">Kelola booking dan pembayaran — lihat detail, edit status, atau hapus.</div>
        </div>
    </div>

    <div class="card">
        <form method="GET" class="mb-4 flex gap-3 items-center">
            <label style="font-weight: 600;">Filter Status:</label>
            <select name="status" class="px-3 py-2 rounded border" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
            @if(request()->has('status'))
                <a href="{{ route('admin.bookings.index') }}" class="text-sm text-gray-500">Reset</a>
            @endif
        </form>

        @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-left text-sm text-gray-600 border-b">
                            <th class="py-2">ID</th>
                            <th class="py-2">Customer</th>
                            <th class="py-2">Paket</th>
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Peserta</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Metode</th>
                            <th class="py-2">Status</th>
                            <th class="py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="border-b">
                                <td class="py-3"><strong>#{{ $booking->id }}</strong></td>
                                <td class="py-3">
                                    <div>{{ $booking->full_name }}</div>
                                    <div class="text-sm text-muted">{{ $booking->email }}</div>
                                </td>
                                <td class="py-3">{{ $booking->package->title ?? '-' }}</td>
                                <td class="py-3">{{ $booking->travel_date ? \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') : '-' }}</td>
                                <td class="py-3">{{ $booking->participants ?? 0 }} orang</td>
                                <td class="py-3">Rp {{ number_format($booking->amount, 0, ',', '.') }}</td>
                                <td class="py-3">
                                    <div>{{ ucfirst($booking->payment_method ?? '-') }}</div>
                                    @if($booking->provider)
                                        <div class="text-sm text-muted">{{ $booking->provider }}</div>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <span style="display:inline-block;padding:0.3rem 0.6rem;border-radius:999px;font-size:0.8rem;font-weight:700;background:{{ $booking->status == 'paid' ? '#d1fae5' : ($booking->status == 'pending' ? '#fef3c7' : ($booking->status == 'cancelled' ? '#fee2e2' : '#e0e7ff')) }};color:{{ $booking->status == 'paid' ? '#065f46' : ($booking->status == 'pending' ? '#92400e' : ($booking->status == 'cancelled' ? '#991b1b' : '#3730a3')) }}">
                                        {{ strtoupper($booking->status) }}
                                    </span>
                                </td>
                                <td class="py-3 text-right">
                                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn">Edit</a>
                                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus booking ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $bookings->links() }}</div>
        @else
            <div style="text-align: center; padding: 3rem; color: #6b7280;">
                Belum ada booking.
            </div>
        @endif
    </div>
</div>
@endsection
