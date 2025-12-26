@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Layanan</h1>
    <p>Halaman layanan masih kosong.</p>
</div>
@if($services->count())
    <div class="layanan-grid">
        @foreach($services->take(6) as $service)
            <div class="layanan-card">
                <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="layanan-img">
                <div class="layanan-title">{{ $service->name }}</div>
                <div class="layanan-desc">{{ $service->description }}</div>
            </div>
        @endforeach
    </div>
@else
    <p style="text-align:center; color:#888; margin:40px 0;">Belum ada layanan yang tersedia.</p>
@endif
@endsection
