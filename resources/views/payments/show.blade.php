@extends('layouts.app')

@section('title', 'Payment Details')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<section class="container2 my-8">
    <div class="bg-white p-6 rounded shadow-sm max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Detail Pembayaran</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">ID Booking:</div>
                <div class="col-span-2">#{{ $payment->id }}</div>
            </div>

            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Paket:</div>
                <div class="col-span-2">{{ $payment->package->title ?? 'N/A' }}</div>
            </div>

            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Nama:</div>
                <div class="col-span-2">{{ $payment->full_name }}</div>
            </div>

            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Email:</div>
                <div class="col-span-2">{{ $payment->email }}</div>
            </div>

            @if($payment->phone)
            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Telepon:</div>
                <div class="col-span-2">{{ $payment->phone }}</div>
            </div>
            @endif

            @if($payment->participants)
            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Peserta:</div>
                <div class="col-span-2">{{ $payment->participants }} orang</div>
            </div>
            @endif

            @if($payment->travel_date)
            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Tanggal Perjalanan:</div>
                <div class="col-span-2">{{ $payment->travel_date->format('d M Y') }}</div>
            </div>
            @endif

            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Total:</div>
                <div class="col-span-2 text-orange-600 font-bold text-lg">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</div>
            </div>

            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Status:</div>
                <div class="col-span-2">
                    @if($payment->status === 'pending')
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm">Menunggu</span>
                    @elseif($payment->status === 'awaiting_confirmation')
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm">Menunggu Konfirmasi</span>
                    @elseif($payment->status === 'paid')
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm">Lunas</span>
                    @elseif($payment->status === 'cancelled')
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm">Dibatalkan</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm">{{ ucfirst($payment->status) }}</span>
                    @endif
                </div>
            </div>

            @if($payment->payment_method)
            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Metode Pembayaran:</div>
                <div class="col-span-2">{{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}</div>
            </div>
            @endif

            @if($payment->requests)
            <div class="grid grid-cols-3 gap-2 py-2 border-b">
                <div class="text-gray-600 font-medium">Catatan:</div>
                <div class="col-span-2 text-sm">{{ $payment->requests }}</div>
            </div>
            @endif

            <div class="grid grid-cols-3 gap-2 py-2">
                <div class="text-gray-600 font-medium">Dibuat:</div>
                <div class="col-span-2 text-sm">{{ $payment->created_at->format('d M Y H:i') }}</div>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            @if($payment->status === 'pending')
                <a href="{{ route('payments.methods', $payment) }}" class="cta-btn">Pilih Metode Pembayaran</a>
            @endif

            @auth
                @if($payment->user_id === auth()->id())
                    <a href="{{ route('payments.edit', $payment) }}" class="btn bg-blue-500 text-white hover:bg-blue-600 px-6 py-2 rounded">Edit</a>
                @endif
            @endauth

            <a href="{{ route('paket.index') }}" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 px-6 py-2 rounded">Kembali ke Paket</a>
        </div>
    </div>
</section>
@endsection
