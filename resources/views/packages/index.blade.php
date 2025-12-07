@extends('layouts.app')

@section('title', 'Paket Wisata')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/packages.css') }}">
@endpush

@section('content')
    <section class="packages-hero">
        <div class="container">
            <div class="section-header" style="text-align:center; margin-bottom:2rem;">
                <h2 class="section-title">Jelajahi Paket Wisata Terbaik</h2>
                <p class="section-sub">Temukan pengalaman liburan yang tak terlupakan dengan paket wisata pilihan kami</p>
            </div>

            <div class="search-bar">
                <input id="searchInput" type="text" placeholder="Cari destinasi atau paket wisata..." value="{{ request('q') }}">
            </div>

            <div class="filters">
                @php $currentDuration = request('duration', 'all'); @endphp
                <button class="filter-btn {{ $currentDuration === 'all' ? 'active' : '' }}" data-duration="all">Semua Paket</button>
                <button class="filter-btn {{ $currentDuration === '1 Hari 2 Malam' ? 'active' : '' }}" data-duration="1 Hari 2 Malam">1 Hari 2 Malam</button>
                <button class="filter-btn {{ $currentDuration === '2 Hari 2 Malam' ? 'active' : '' }}" data-duration="2 Hari 2 Malam">2 Hari 2 Malam</button>
                <button class="filter-btn {{ $currentDuration === '3 Hari 3 Malam' ? 'active' : '' }}" data-duration="3 Hari 3 Malam">3 Hari 3 Malam</button>
            </div>

            <div class="tour-grid" id="tourGrid">
                @forelse($packages as $package)
                <div class="tour-card">
                    <div style="position:relative">
                        <div class="tour-cover">
                               <img src="{{ $package->cover_image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80' }}" alt="{{ $package->title }}" onerror="this.onerror=null;this.src='{{ asset('images/download.jpeg') }}';">
                        </div>
                        <div class="badge-left">-29%</div>
                        <div class="badge-right">{{ $package->duration ?? '2H 2M' }}</div>
                    </div>

                    <div class="card-body">
                        <div class="tour-row">
                            <div class="tour-title"><a href="{{ route('paket.show', $package->slug) }}">{{ $package->title }}</a></div>
                            <div class="tour-sub">{{ Str::limit($package->excerpt ?: $package->description, 60) }}</div>
                        </div>

                        <div class="tour-meta">
                            <div>
                                <span style="display:inline-block; margin-right:.5rem; color:#ff7a18">★</span>
                                <span style="font-weight:700;">4.8</span> • <span>1200+ peserta</span>
                            </div>
                            <div class="tour-price">
                                <div>
                                    <div class="price-old">Rp 3.500.000</div>
                                    <div class="price-now">Rp {{ number_format($package->price ?? 0,0,',','.') }} /orang</div>
                                </div>
                                <a href="{{ route('paket.show', $package->slug) }}" class="cta-btn">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-600 py-8">Belum ada paket tersedia.</div>
                @endforelse
            </div>

            <div class="mt-8">{{ $packages->links() }}</div>
        </div>
    </section>

        <script>
            (function(){
                const searchInput = document.getElementById('searchInput');
                const buttons = document.querySelectorAll('.filter-btn');

                function buildUrl(params) {
                    const url = new URL(window.location.href);
                    Object.keys(params).forEach(k => {
                        if (params[k] === null || params[k] === undefined || params[k] === '') {
                            url.searchParams.delete(k);
                        } else {
                            url.searchParams.set(k, params[k]);
                        }
                    });
                    return url.toString();
                }

                buttons.forEach(b => {
                    b.addEventListener('click', function(){
                        const duration = this.getAttribute('data-duration');
                        const q = (searchInput && searchInput.value) ? searchInput.value.trim() : '';
                        // Redirect to site root (home) with query params so search results are shown on the home page
                        const homeUrl = new URL(window.location.origin + '/');
                        if (q) homeUrl.searchParams.set('q', q);
                        if (duration && duration !== 'all') homeUrl.searchParams.set('duration', duration);
                        window.location.href = homeUrl.toString();
                    });
                });

                if (searchInput) {
                    searchInput.addEventListener('keydown', function(e){
                        if (e.key === 'Enter') {
                            const duration = '{{ request('duration', 'all') }}';
                            const q = this.value.trim();
                            const homeUrl = new URL(window.location.origin + '/');
                            if (q) homeUrl.searchParams.set('q', q);
                            if (duration && duration !== 'all') homeUrl.searchParams.set('duration', duration);
                            window.location.href = homeUrl.toString();
                        }
                    });
                }
            })();
        </script>
<!-- outer wrapper removed to make hero sit closer to navbar -->
@endsection
