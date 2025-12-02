@extends('layouts.app')

@section('title', 'GoTour - Platform Wisata Terbaik Indonesia')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@if(isset($packages))
<link rel="stylesheet" href="{{ asset('css/packages.css') }}">
@endif
@endpush

@section('content')

<!-- Hero Slider -->
<section id="beranda" class="hero-slider scroll-animate">
    <div class="slide active">
        <img src="https://images.unsplash.com/photo-1621317703199-ac9587012f72?w=1080&q=80" alt="Wisata Bandung">
        <div class="slide-overlay">
            <div class="slide-content">
                <h1>Selamat Datang di GoTour</h1>
                <p>Kami membantu membuat liburan Anda menjadi lebih mudah dan menyenangkan.</p>
            </div>
        </div>
    </div>

    <div class="slide">
        <img src="https://images.unsplash.com/photo-1743699537171-750edd44bd87?w=1080&q=80" alt="Petualangan">
        <div class="slide-overlay">
            <div class="slide-content">
                <h1>Ayo Menjelajah Bersama Kami</h1>
                <p>Kami telah melayani ribuan wisatawan dengan hasil yang memuaskan.</p>
            </div>
        </div>
    </div>

    <div class="slide">
        <img src="https://images.unsplash.com/photo-1710590800221-6cfc84ab69d2?w=1080&q=80" alt="Resort Pegunungan">
        <div class="slide-overlay">
            <div class="slide-content">
                <h1>Banyak Pilihan Destinasi</h1>
                <p>Sesuaikan liburanmu, kapan aja, di mana aja.</p>
            </div>
        </div>
    </div>

    <button class="slider-btn prev" onclick="changeSlide(-1)">‹</button>
    <button class="slider-btn next" onclick="changeSlide(1)">›</button>

    <div class="slider-dots">
        <span class="dot active" onclick="currentSlide(0)"></span>
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
    </div>
</section>

@if(isset($packages))
<!-- Search results (rendered on the home page when q/duration provided) -->
<section class="container search-results" style="padding-top:20px; padding-bottom:40px;">
    <div class="section-header" style="text-align:left; margin-bottom:16px;">
        <h2 class="section-title">Hasil Pencarian</h2>
        <p class="section-sub">Menampilkan hasil pencarian untuk "{{ request('q') }}"</p>
    </div>

    <div class="tour-grid" id="searchGrid">
        @forelse($packages as $package)
            <div class="tour-card">
                <div style="position:relative">
                    <div class="tour-cover">
                        <img src="{{ $package->cover_image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80' }}" alt="{{ $package->title }}" onerror="this.onerror=null;this.src='{{ asset('images/download.jpeg') }}';">
                    </div>
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
            <div class="col-span-3 text-center text-gray-600 py-8">Tidak ada hasil yang cocok.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $packages->links() }}</div>
</section>
@endif

<!-- About Section -->
<div class="container2" id="tentang">
    <section class="about-section scroll-animate">
        <h2>Visi dan Misi</h2>
        <p>Visi kami adalah menjadi platform terbaik untuk membantu pengguna menjelajahi dunia dengan cara yang mudah dan menyenangkan. Misi kami adalah menyediakan layanan berkualitas tinggi yang mengutamakan kebutuhan pelanggan, serta memberikan pengalaman tak terlupakan dalam setiap perjalanan Anda.</p>
    </section>

    <section class="about-section who-we-are scroll-animate">
        <h2>Siapa Kami?</h2>
        <p>Kami adalah tim yang berdedikasi dalam menciptakan aplikasi perjalanan yang memudahkan pengguna untuk menemukan, merencanakan, dan menikmati destinasi impian mereka. Dengan pengalaman bertahun-tahun di industri pariwisata, kami berkomitmen untuk memberikan layanan terbaik kepada Anda.</p>
    </section>

    <section class="about-section scroll-animate">
        <h2>Tim Kami</h2>
        <div class="team">
            <div class="team-member scroll-animate">
                <img src="{{ asset('images/fotoshara.jpg') }}" alt="Shara Anjelia">
                <h3>Shara Anjelia</h3>
                <p>CEO & Pendiri </p>
            </div>

            <div class="team-member scroll-animate">
                <img src="{{ asset('images/Fataya.jpg') }}" alt="Fataya Pratama">
                <h3>Fataya Pratama</h3>
                <p>Kepala Operasi</p>
            </div>

            <div class="team-member scroll-animate">
                <img src="{{ asset('images/fotokhai.jpg') }}" alt="Khairunnisa">
                <h3>Khairunnisa Nur Aqila</h3>
                <p>Desainer UI/UX</p>
            </div>
        </div>
    </section>
</div>

<!-- Category Section -->
<section id="kategori" class="category-section">
        <div class="container">
            <div class="section-header scroll-animate">
                <h2>Kategori Wisata</h2>
                <p>Temukan berbagai jenis wisata yang sesuai dengan minat dan keinginan Anda</p>
            </div>
            <div class="category-grid">
                <div class="category-card scroll-animate">
                    <div class="category-icon">🏔️</div>
                    <h3>Wisata Alam</h3>
                    <p>Jelajahi keindahan alam Indonesia dengan pegunungan, air terjun, dan pemandangan menakjubkan.</p>
                </div>
                <div class="category-card scroll-animate">
                    <div class="category-icon">🏢</div>
                    <h3>Wisata Kota</h3>
                    <p>Kunjungi kota-kota bersejarah dan modern dengan berbagai atraksi menarik.</p>
                </div>
                <div class="category-card scroll-animate">
                    <div class="category-icon">📸</div>
                    <h3>Wisata Budaya</h3>
                    <p>Rasakan kekayaan budaya Indonesia melalui seni, tradisi, dan warisan leluhur.</p>
                </div>
                <div class="category-card scroll-animate">
                    <div class="category-icon">🍜</div>
                    <h3>Wisata Kuliner</h3>
                    <p>Nikmati kelezatan kuliner nusantara dari berbagai daerah di Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

<!-- Services Section -->
    <section id="layanan" class="services-section">
        <div class="container">
            <div class="section-header scroll-animate">
                <h2>Layanan Kami</h2>
                <p>Kami menyediakan berbagai layanan untuk memastikan perjalanan wisata Anda berjalan lancar dan menyenangkan</p>
            </div>
            <div class="services-grid">
                <div class="service-card scroll-animate">
                    <div class="service-icon">📦</div>
                    <h3>Paket Wisata</h3>
                    <p>Berbagai paket wisata lengkap dengan itinerary yang telah dirancang khusus untuk kenyamanan Anda.</p>
                </div>
                <div class="service-card scroll-animate">
                    <div class="service-icon">👥</div>
                    <h3>Pemandu Wisata</h3>
                    <p>Pemandu wisata berpengalaman yang siap menemani dan memberikan informasi selama perjalanan.</p>
                </div>
                <div class="service-card scroll-animate">
                    <div class="service-icon">🚌</div>
                    <h3>Transportasi</h3>
                    <p>Layanan transportasi yang nyaman dan aman untuk perjalanan wisata Anda.</p>
                </div>
                <div class="service-card scroll-animate">
                    <div class="service-icon">🏨</div>
                    <h3>Akomodasi</h3>
                    <p>Pilihan akomodasi terbaik dari hotel berbintang hingga penginapan yang nyaman.</p>
                </div>
                <div class="service-card scroll-animate">
                    <div class="service-icon">✨</div>
                    <h3>Aktivitas Tambahan</h3>
                    <p>Berbagai aktivitas menarik yang dapat disesuaikan dengan minat dan kebutuhan Anda.</p>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    window.showSlide = function(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            dots[i].classList.remove('active');
        });
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }

    window.changeSlide = function(direction) {
        currentSlideIndex += direction;
        if (currentSlideIndex < 0) currentSlideIndex = slides.length - 1;
        if (currentSlideIndex >= slides.length) currentSlideIndex = 0;
        showSlide(currentSlideIndex);
    }

    window.currentSlide = function(index) {
        currentSlideIndex = index;
        showSlide(currentSlideIndex);
    }

    setInterval(() => changeSlide(1), 7000);

    // Mobile menu
    const toggle = document.getElementById('menuToggle');
    const nav = document.getElementById('navLinks');
    if(toggle && nav){
        toggle.addEventListener('click', () => {
            nav.style.display = (nav.style.display === 'flex') ? 'none' : 'flex';
        });
    }

    // Scroll animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
});
</script>
@endpush
