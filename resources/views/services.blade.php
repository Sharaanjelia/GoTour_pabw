@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<style>
    .header-layanan {
        text-align: center;
        margin-top: 48px;
        margin-bottom: 24px;
    }
    .header-layanan-title {
        font-size: 2.7rem;
        font-weight: bold;
        color: #1a237e;
        margin-bottom: 8px;
    }
    .header-layanan-subtitle {
        font-size: 1.15rem;
        color: #555;
    }
    .layanan-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 32px;
        max-width: 1100px;
        margin: 0 auto 48px auto;
        padding: 0 16px;
    }
    .layanan-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 18px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        width: 320px;
        max-width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 22px 20px 20px 20px;
        transition: box-shadow 0.2s;
    }
    .layanan-card:hover {
        box-shadow: 0 6px 24px rgba(30,64,175,0.10);
    }
    .layanan-img {
        width: 100%;
        max-width: 220px;
        height: 140px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 18px;
    }
    .layanan-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #1976d2;
        margin-bottom: 8px;
        text-align: center;
    }
    .layanan-desc {
        font-size: 1rem;
        color: #444;
        text-align: center;
        margin-bottom: 0;
    }
    .layanan-desc a {
        color: #1976d2;
        text-decoration: none;
        font-weight: 500;
    }
    .layanan-desc a:hover {
        text-decoration: underline;
    }
    @media (max-width: 900px) {
        .layanan-grid {
            gap: 20px;
        }
        .layanan-card {
            width: 90%;
            max-width: 400px;
        }
    }
    @media (max-width: 600px) {
        .header-layanan-title {
            font-size: 2rem;
        }
        .layanan-grid {
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }
        .layanan-card {
            width: 100%;
            max-width: 100%;
        }
    }
</style>
<div class="header-layanan">
    <div class="header-layanan-title">Layanan Kami</div>
    <div class="header-layanan-subtitle">Temukan berbagai layanan terbaik kami untuk pengalaman wisata yang tak terlupakan.</div>
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
