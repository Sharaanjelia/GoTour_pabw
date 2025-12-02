@extends('layouts.app')

@section('title', 'My Bookings')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<section class="container2 my-8">
    <div class="bg-white p-6 rounded shadow-sm">
        <h1 class="text-3xl font-bold mb-6">Booking Saya</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($payments && $payments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Paket</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">#{{ $payment->id }}</td>
                            <td class="px-4 py-3">{{ $payment->package->title ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $payment->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 font-semibold">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @if($payment->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Menunggu</span>
                                @elseif($payment->status === 'awaiting_confirmation')
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Konfirmasi</span>
                                @elseif($payment->status === 'paid')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Lunas</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">{{ ucfirst($payment->status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('payments.show', $payment) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($payments, 'links'))
                <div class="mt-6">
                    {{ $payments->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 mb-4">Anda belum memiliki booking.</p>
                <a href="{{ route('paket.index') }}" class="cta-btn inline-block">Jelajahi Paket Wisata</a>
            </div>
        @endif
    </div>
</section>
@endsection
