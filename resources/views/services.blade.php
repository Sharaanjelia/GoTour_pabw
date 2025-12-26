@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<style>
    .header-layanan {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 16px;
    }
    .header-layanan-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 8px;
        color: #1a237e;
    }
    .header-layanan-subtitle {
        font-size: 1.1rem;
        color: #555;
    }
    .layanan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        max-width: 1100px;
        margin: 40px auto 0 auto;
        padding: 0 16px 40px 16px;
    }
    .layanan-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 18px 18px 14px 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: box-shadow 0.2s;
    }
    .layanan-card:hover {
        box-shadow: 0 4px 16px rgba(30,64,175,0.10);
    }
    .layanan-image-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
    }
    .layanan-img {
        width: 100%;
        max-width: 240px;
        aspect-ratio: 4/3;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 0;
    }
    .layanan-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        border-radius: 14px;
    }
    .layanan-title {
        font-size: 1.15rem;
        font-weight: bold;
        color: #1976d2;
        margin-bottom: 4px;
        text-align: center;
    }
    .layanan-desc {
        font-size: 1rem;
        color: #444;
        text-align: center;
        margin-bottom: 0;
    }
    @media (max-width: 900px) {
        .layanan-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 600px) {
        .header-layanan-title {
            font-size: 2rem;
        }
        .layanan-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }
    }
</style>

<div class="header-layanan">
    <div class="header-layanan-title">Layanan Kami</div>
    <div class="header-layanan-subtitle">Temukan berbagai layanan terbaik kami untuk pengalaman wisata yang tak terlupakan.</div>
</div>
@if($services->count())
    <div class="layanan-grid">
        @foreach($services as $service)
            <div class="layanan-card">
                <div class="layanan-image-wrapper">
                    @if($service->image_url)
                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="layanan-img">
                    @else
                        <div class="layanan-placeholder">
                            <span style="font-size:3rem;color:#bdbdbd;">&#128100;</span>
                        </div>
                    @endif
                </div>
                <div class="layanan-title">{{ $service->name }}</div>
                <div class="layanan-desc">{{ $service->description }}</div>
            </div>
        @endforeach
    </div>
@else
    <p style="text-align:center; color:#888; margin:40px 0;">Belum ada layanan yang tersedia.</p>
@endif
@endsection
