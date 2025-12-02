@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<style>
    body {
        background: #f9fafb;
    }
    .services-hero {
        text-align: center;
        padding: 2.5rem 1.5rem 2rem;
        background: white;
        border-bottom: 1px solid #e5e7eb;
    }
    .services-hero h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #1a1a1a;
    }
    .services-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 2rem;
    }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }
    .service-card {
        background: white;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }
    .service-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .service-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        display: block;
    }
    .service-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d1d5db;
    }
    .service-card:hover .service-image {
        transform: scale(1.1);
    }
    .service-content {
        padding: 1.5rem;
        text-align: center;
    }
    .service-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    .service-description {
        font-size: 0.9rem;
        color: #6b7280;
        line-height: 1.6;
    }
    @media (max-width: 1200px) {
        .services-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .services-hero h1 {
            font-size: 1.75rem;
        }
    }
    @media (max-width: 480px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="services-hero">
    <h1>Layanan Kami</h1>
</div>

<div class="services-container">
    <div class="services-grid">
        @foreach($services as $s)
            <div class="service-card">
                <div class="service-image-wrapper">
                    @if($s->image_url)
                        <img src="{{ $s->image_url }}" alt="{{ $s->name }}" class="service-image">
                    @else
                        <div class="service-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 64px; height: 64px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="service-content">
                    <h3 class="service-name">{{ $s->name }}</h3>
                    <p class="service-description">{{ $s->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
