@extends('layouts.app')

@section('title','Testimoni')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    .testimonials-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 1.5rem;
    }
    .testimonials-hero {
        text-align: center;
        margin-bottom: 4rem;
    }
    .testimonials-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    .testimonials-subtitle {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.9);
        font-weight: 300;
    }
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }
    .testimonial-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
    }
    .testimonial-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }
    .testimonial-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .testimonial-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .testimonial-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 4rem;
    }
    .testimonial-content {
        padding: 1.5rem;
    }
    .testimonial-message {
        font-size: 0.95rem;
        color: #4a5568;
        line-height: 1.7;
        margin-bottom: 1rem;
        font-style: italic;
    }
    .testimonial-name {
        font-size: 1rem;
        font-weight: 700;
        color: #667eea;
    }
    .testimonial-email {
        font-size: 0.875rem;
        color: #9ca3af;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
    }
</style>
@endpush

@section('content')
<div class="testimonials-container">
    <div class="testimonials-hero">
        <h1 class="testimonials-title">💬 Testimoni Pelanggan</h1>
        <p class="testimonials-subtitle">Berbagai pengalaman dan review dari pelanggan GoTour</p>
    </div>

    @if($items->count() > 0)
        <div class="testimonials-grid">
            @foreach($items as $item)
                <div class="testimonial-card">
                    <div class="testimonial-image-wrapper">
                        @if($item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="testimonial-image">
                        @else
                            <div class="testimonial-placeholder">
                                👤
                            </div>
                        @endif
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-message">"{{ $item->message }}"</p>
                        <div class="testimonial-name">{{ $item->name }}</div>
                        @if($item->email)
                            <div class="testimonial-email">{{ $item->email }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($items->hasPages())
            <div style="text-align: center;">
                {{ $items->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">💬</div>
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Belum Ada Testimoni</h3>
            <p style="color: #6b7280;">Testimoni pelanggan akan segera tersedia</p>
        </div>
    @endif
</div>
@endsection
