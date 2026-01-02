@extends('layouts.app')

@section('title', 'Beri Testimoni')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Beri Testimoni untuk Trip/Paket</h2>
    <form method="POST" action="{{ route('testimoni.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($trip))
            <input type="hidden" name="payment_id" value="{{ $trip->payment_id ?? '' }}">
        @endif
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" id="name" class="form-input w-full" value="{{ old('name', auth()->user()->name ?? '') }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" class="form-input w-full" value="{{ old('email', auth()->user()->email ?? '') }}">
        </div>
        <div class="mb-4">
            <label for="message" class="block font-semibold mb-1">Pesan Testimoni</label>
            <textarea name="message" id="message" class="form-textarea w-full" rows="4" required>{{ old('message') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="photo" class="block font-semibold mb-1">Foto (opsional)</label>
            <input type="file" name="photo" id="photo" class="form-input w-full" accept="image/*">
        </div>
        <div class="mb-4">
            <label for="rating" class="block font-semibold mb-1">Rating (1-5)</label>
            <select name="rating" id="rating" class="form-select w-full" required>
                <option value="">Pilih rating</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}" @if(old('rating')==$i) selected @endif>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
    </form>
</div>
@endsection
