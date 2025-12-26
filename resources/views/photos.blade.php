@extends('layouts.app')

@section('title', 'Rekomendasi Foto Wisata Bandung')

@push('styles')
<style>
    body { background: #f9fafb; }
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    .photo-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .photo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    .photo-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    .photo-content {
        padding: 1.5rem;
    }
    .photo-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    .photo-description {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }
</style>
@endpush

@section('content')
<<<<<<< HEAD
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
=======
<div class="hero-section">
    <h1>📸 Rekomendasi Foto Wisata Bandung</h1>
    <p>Spot foto terbaik dan paling Instagram-worthy di Kota Kembang</p>
</div>

<div class="container-custom">
    @if($items->count() > 0)
        <div class="photo-grid">
            @foreach($items as $item)
                <div class="photo-card">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="photo-image">
                    @else
                        <div class="photo-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                            📷
                        </div>
                    @endif
                    <div class="photo-content">
                        <h3 class="photo-title">{{ $item->title }}</h3>
                        @if($item->description)
                            <p class="photo-description">{{ Str::limit($item->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($items->hasPages())
            <div style="margin-top: 3rem;">
                {{ $items->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📸</div>
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Belum Ada Rekomendasi Foto</h3>
            <p style="color: #6b7280;">Rekomendasi foto wisata akan segera hadir</p>
        </div>
    @endif
>>>>>>> c4b17dfc592e85706dd21f3a5dede2532513366d
</div>
@endsection
