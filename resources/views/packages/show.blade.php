@extends('layouts.app')

@section('title', $package->title)

@push('styles')
<style>
    body {
        background: #f9fafb;
    }
    .package-detail-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }
    .package-detail-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .package-main {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }
    .package-cover {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .package-content {
        padding: 2rem;
    }
    .package-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.75rem;
    }
    .package-meta {
        display: flex;
        gap: 2rem;
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .package-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .package-description {
        color: #374151;
        font-size: 1rem;
        line-height: 1.8;
        white-space: pre-line;
    }
    .package-sidebar {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }
    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }
    .sidebar-excerpt {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .sidebar-info {
        margin-bottom: 1rem;
    }
    .sidebar-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.25rem;
    }
    .sidebar-value {
        color: #6b7280;
    }
    .sidebar-price {
        background: #fef3c7;
        padding: 1rem;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    .sidebar-price-label {
        font-size: 0.875rem;
        color: #92400e;
        margin-bottom: 0.25rem;
    }
    .sidebar-price-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #92400e;
    }
    .cta-btn {
        display: block;
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #0ea5a2 0%, #0d8e8b 100%);
        color: white;
        text-align: center;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 165, 162, 0.3);
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    .back-link:hover {
        color: #0ea5a2;
    }
    @media (max-width: 768px) {
        .package-detail-grid {
            grid-template-columns: 1fr;
        }
        .package-sidebar {
            position: static;
        }
        .package-cover {
            height: 300px;
        }
        .package-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="package-detail-container">
    <div class="package-detail-grid">
        <div class="package-main">
            <img src="{{ $package->cover_image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80' }}" alt="{{ $package->title }}" class="package-cover" onerror="this.onerror=null;this.src='{{ asset('images/download.jpeg') }}';">
            
            <div class="package-content">
                <h1 class="package-title">{{ $package->title }}</h1>
                
                <div class="package-meta">
                    <div class="package-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>{{ $package->duration }}</span>
                    </div>
                    <div class="package-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        <span>1200+ peserta</span>
                    </div>
                </div>
                
                <div class="package-description">{{ Str::of($package->description)->before('Fasilitas') }}</div>

                @php
                    $fasilitas = null;
                    if (Str::contains($package->description, 'Fasilitas')) {
                        $fasilitas = trim(Str::of($package->description)->after('Fasilitas'));
                    }
                @endphp

                @if($fasilitas)
                <div class="itinerary-section" style="margin-top:2.5rem;">
                    <h2 style="font-size:1.15rem;font-weight:700;color:#0ea5a2;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 22px; height: 22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        Fasilitas
                    </h2>
                    <div style="background:#f0fdfa;border-radius:12px;padding:1.2rem 1.5rem 1.2rem 1.5rem;box-shadow:0 2px 8px rgba(14,165,162,0.08);margin-bottom:2rem;">
                        <ul style="list-style:disc inside;line-height:2;font-size:1.05rem;color:#166a6a;">
                        @foreach(preg_split('/\r?\n/', $fasilitas) as $item)
                            @if(trim($item))
                                <li>{{ trim($item) }}</li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if(is_array($package->itinerary) && count($package->itinerary))
                <div class="rundown-section" style="margin-top:0.5rem;">
                    <h2 style="font-size:1.15rem;font-weight:700;color:#0ea5a2;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 22px; height: 22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        Rundown / Jadwal Harian
                    </h2>
                    <div class="timeline">
                        @foreach($package->itinerary as $i => $item)
                            @if(trim($item))
                            <div class="timeline-item" style="animation-delay: {{ 0.1 * $i }}s;">
                                <div class="timeline-dot">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#0ea5a2" viewBox="0 0 24 24" width="22" height="22"><circle cx="12" cy="12" r="10" fill="#f0fdfa"/><text x="12" y="16" text-anchor="middle" font-size="12" fill="#0ea5a2" font-weight="bold">{{ $i+1 }}</text></svg>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Hari {{ $i+1 }}</div>
                                    <div class="timeline-desc">{{ $item }}</div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <style>
                .timeline {
                    position: relative;
                    margin-left: 1.5rem;
                    padding-left: 1.5rem;
                    border-left: 3px solid #0ea5a2;
                }
                .timeline-item {
                    display: flex;
                    align-items: flex-start;
                    margin-bottom: 2rem;
                    opacity: 0;
                    transform: translateY(20px);
                    animation: fadeInUp 0.5s forwards;
                }
                .timeline-dot {
                    margin-left: -2.1rem;
                    margin-right: 1rem;
                    flex-shrink: 0;
                }
                .timeline-title {
                    font-weight: 700;
                    color: #0ea5a2;
                    font-size: 1.08rem;
                    margin-bottom: 0.2rem;
                }
                .timeline-desc {
                    color: #166a6a;
                    font-size: 1.01rem;
                }
                @keyframes fadeInUp {
                    to {
                        opacity: 1;
                        transform: none;
                    }
                }
                </style>
                @endif
            </div>
        </div>

        <aside class="package-sidebar">
            <h3 class="sidebar-title">Informasi Paket</h3>
            
            @if($package->excerpt)
                <p class="sidebar-excerpt">{{ $package->excerpt }}</p>
            @endif
            
            <div class="sidebar-info">
                <div class="sidebar-label">Durasi</div>
                <div class="sidebar-value">{{ $package->duration }}</div>
            </div>
            
            <div class="sidebar-price">
                <div class="sidebar-price-label">Harga per orang</div>
                <div class="sidebar-price-value">Rp {{ number_format($package->price ?? 0, 0, ',', '.') }}</div>
            </div>
            
            @guest
                <a href="{{ route('login') }}" class="cta-btn" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    Login untuk Pesan
                </a>
                <p style="text-align: center; color: #6b7280; font-size: 0.875rem; margin-top: 0.75rem;">
                    Silakan login terlebih dahulu untuk melakukan pemesanan
                </p>
            @else
                <a href="{{ route('payments.create', ['package_id' => $package->id]) }}" class="cta-btn">Pesan Sekarang</a>
            @endguest
        </aside>
    </div>

    <a href="{{ route('paket.index') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Kembali ke semua paket
    </a>
</div>
@endsection
