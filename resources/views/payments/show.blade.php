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

    {{-- Form Testimoni --}}
    @auth
        @if($payment->status === 'paid' && !$payment->testimonial)
        <div class="bg-blue-50 mt-10 p-6 rounded shadow-sm max-w-2xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Beri Testimoni</h2>
            <form action="{{ route('testimoni.store') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                <div class="mb-4">
                    <label for="content" class="block font-medium mb-1">Testimoni Anda</label>
                    <textarea name="content" id="content" rows="4" class="w-full border rounded p-2" required>{{ old('content') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="rating" class="block font-medium mb-1">Rating</label>
                    <select name="rating" id="rating" class="w-32 border rounded p-2" required>
                        <option value="">Pilih rating</option>
                        @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Kirim Testimoni</button>
            </form>
        </div>
        @elseif($payment->testimonial)
        <div class="bg-green-50 mt-10 p-6 rounded shadow-sm max-w-2xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Testimoni Anda</h2>
            <div class="mb-2 text-gray-700">"{{ $payment->testimonial->content }}"</div>
            <div class="text-yellow-500 font-bold">Rating: {{ $payment->testimonial->rating }} / 5</div>
        </div>
        @endif
    @endauth
</section>
@endsection
