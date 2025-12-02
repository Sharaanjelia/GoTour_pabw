@extends('layouts.app')

@section('title', 'Edit Booking')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/packages.css') }}">
@endpush

@section('content')
<section class="container2 my-8">
    <div class="bg-white p-6 rounded shadow-sm max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Edit Booking</h1>

        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Pilih Paket <span class="text-red-500">*</span></label>
                <select name="package_id" class="form-input w-full" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}" {{ $payment->package_id == $pkg->id ? 'selected' : '' }}>
                            {{ $pkg->title }} - Rp {{ number_format($pkg->price ?? 0, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('package_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name', $payment->full_name) }}" class="form-input w-full" required>
                @error('full_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $payment->email) }}" class="form-input w-full" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $payment->phone) }}" class="form-input w-full">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Jumlah Peserta</label>
                    <input type="number" name="participants" value="{{ old('participants', $payment->participants) }}" min="1" class="form-input w-full">
                    @error('participants')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Tanggal Perjalanan</label>
                    <input type="date" name="travel_date" value="{{ old('travel_date', $payment->travel_date?->format('Y-m-d')) }}" class="form-input w-full">
                    @error('travel_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Total Pembayaran <span class="text-red-500">*</span></label>
                <input type="number" name="amount" value="{{ old('amount', $payment->amount) }}" class="form-input w-full" required>
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Permintaan Khusus</label>
                <textarea name="requests" rows="3" class="form-input w-full" placeholder="Catatan atau permintaan khusus...">{{ old('requests', $payment->requests) }}</textarea>
                @error('requests')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="cta-btn">Update Booking</button>
                <a href="{{ route('payments.show', $payment) }}" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 px-6 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</section>
@endsection
