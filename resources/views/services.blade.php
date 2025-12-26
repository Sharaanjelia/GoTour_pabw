@extends('layouts.app')

@section('title', 'Layanan GoTour')

@push('styles')
<style>
    body { background: #f9fafb; }
    .hero-section {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        padding: 4rem 2rem;
        text-align: center;
        color: white;
    }
    .hero-section h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }
    .hero-section p {
        font-size: 1.125rem;
        opacity: 0.9;
    }
    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
    }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }
    .service-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        border-color: #06b6d4;
    }
    .service-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }
    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    .service-description {
        color: #6b7280;
        line-height: 1.7;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
</style>
@endpush

@section('content')
<div class="hero-section">
    <h1>🎯 Layanan GoTour</h1>
    <p>Berbagai layanan terbaik untuk membuat liburan Anda lebih mudah dan menyenangkan</p>
</div>

<div class="container-custom">
    @if($services->count() > 0)
        <div class="services-grid">
            @foreach($services as $item)
                <div class="service-card">
                    <div class="service-icon">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                        @else
                            🎯
                        @endif
                    </div>
                    <h3 class="service-title">{{ $item->title }}</h3>
                    @if($item->description)
                        <p class="service-description">{{ $item->description }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        @if($services instanceof \Illuminate\Pagination\LengthAwarePaginator && $services->hasPages())
            <div style="margin-top: 3rem;">
                {{ $services->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">🎯</div>
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Belum Ada Layanan</h3>
            <p style="color: #6b7280;">Layanan akan segera tersedia</p>
        </div>
    @endif
</div>
@endsection
