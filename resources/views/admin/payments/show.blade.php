@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/packages.css') }}">
@endpush

@section('content')
<main class="max-w-4xl mx-auto px-4 py-8">
    <button onclick="window.history.back()" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </button>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Pembayaran</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="text-sm text-gray-500">ID</div>
                <div class="font-semibold">#{{ $payment->id }}</div>

                <div class="mt-4 text-sm text-gray-500">User</div>
                <div class="font-semibold">{{ optional($payment->user)->name ?? '—' }}</div>

                <div class="mt-4 text-sm text-gray-500">Package</div>
                <div class="font-semibold">{{ optional($payment->package)->title ?? '—' }}</div>

                <div class="mt-4 text-sm text-gray-500">Tanggal dibuat</div>
                <div class="font-semibold">{{ $payment->created_at->toDateTimeString() }}</div>

                <div class="mt-4 text-sm text-gray-500">Status</div>
                <div class="font-semibold">{{ ucfirst($payment->status) }}</div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Harga per orang</div>
                <div class="font-semibold">Rp {{ number_format(optional($payment->package)->price ?? 0,0,',','.') }}</div>

                <div class="mt-4 text-sm text-gray-500">Jumlah peserta</div>
                <div class="font-semibold">—</div>

                <div class="mt-4 text-sm text-gray-500">Total Pembayaran</div>
                <div class="font-semibold text-orange-500">Rp {{ number_format($payment->amount ?? 0,0,',','.') }}</div>

                <div class="mt-4 text-sm text-gray-500">Metode</div>
                <div class="font-semibold">{{ $payment->payment_method ?? '—' }}</div>

                <div class="mt-4 text-sm text-gray-500">Transaction ID</div>
                <div class="font-semibold">{{ $payment->transaction_id ?? '—' }}</div>
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <a href="{{ route('admin.payments.edit', $payment) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">Edit</a>
            <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini?');">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
            </form>
        </div>
    </div>
</main>
@endsection
