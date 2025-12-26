@extends('layouts.app')

@section('title', 'Rekomendasi Foto')

@section('content')
<style>
    .header-foto {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 16px;
    }
    .header-foto-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 8px;
        color: #222;
    }
    .header-foto-subtitle {
        font-size: 1.1rem;
        color: #666;
    }
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 28px;
        max-width: 1200px;
        margin: 40px auto 0 auto;
        padding: 0 16px 40px 16px;
    }
    .foto-card {
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
    .foto-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .foto-img {
        width: 100%;
        max-width: 240px;
        aspect-ratio: 4/3;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 14px;
    }
    .foto-title {
        font-size: 1.15rem;
        font-weight: bold;
        color: #222;
        margin-bottom: 4px;
        text-align: center;
    }
    .foto-category {
        font-size: 0.98rem;
        color: #666;
        text-align: center;
    }
    @media (max-width: 900px) {
        .foto-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 600px) {
        .header-foto-title {
            font-size: 2rem;
        }
        .foto-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }
    }
</style>
<div class="header-foto">
    <div class="header-foto-title">Rekomendasi Foto</div>
    <div class="header-foto-subtitle">Temukan inspirasi dari koleksi foto terbaik</div>
</div>
<div class="foto-grid">
    @forelse($items as $index => $photo)
        <div class="foto-card">
            <img src="{{ asset('storage/'.$photo->image) }}" alt="Gaya Foto {{ $index+1 }}" class="foto-img">
            <div class="foto-title">Gaya Foto {{ $index+1 }}</div>
            <div class="foto-category">{{ $photo->description }}</div>
        </div>
    @empty
        <p class="text-center text-gray-500" style="grid-column: 1/-1;">Halaman foto rekomendasi masih kosong.</p>
    @endforelse
</div>
<div style="margin: 32px 0; text-align:center;">
    {{ $items->links() }}
</div>
@endsection
