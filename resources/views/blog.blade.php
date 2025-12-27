@extends('layouts.app')

@section('title', 'Blog - Panduan Wisata Bandung')

@push('styles')
<style>
    body {
        background: #ffffff;
    }
    
    /* Hero Section */
    .blog-hero {
        background: linear-gradient(135deg, #0e2238 0%, #0e2238 100%);
        padding: 4rem 1.5rem 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .blog-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(147, 197, 253, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }
    .blog-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(59, 130, 246, 0.1);
        color: #0e2238;
        padding: 0.5rem 1.25rem;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }
    .blog-hero-badge svg {
        width: 16px;
        height: 16px;
    }
    .blog-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 1rem;
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }
    .blog-hero h1 .highlight {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .blog-hero {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        padding: 4rem 1.5rem 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
        z-index: 1;
    }

    /* Blog Section */
    .blog-section {
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 6rem;
    }
    .blog-section-header {
        margin-bottom: 3rem;
    }
    .blog-section-title {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }
    .blog-section-subtitle {
        color: #64748b;
        font-size: 1rem;
        line-height: 1.6;
    }

    /* Blog Grid */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 4rem 3.5rem;
        margin-bottom: 3rem;
    }

    /* Blog Card */
    .blog-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }
    .blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: #cbd5e1;
    }
    
    .blog-card-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 60%;
        overflow: hidden;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }
    .blog-card-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .blog-card:hover .blog-card-image {
        transform: scale(1.05);
    }
    .blog-card-category {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: white;
        color: #2563eb;
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        z-index: 2;
    }
    
    .blog-card-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .blog-card-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
        color: #94a3b8;
    }
    .blog-card-meta-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    .blog-card-meta svg {
        width: 14px;
        height: 14px;
    }
    .blog-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .blog-card-excerpt {
        color: #64748b;
        font-size: 0.9375rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .blog-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
    }
    .blog-card-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #2563eb;
        font-weight: 600;
        font-size: 0.9375rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .blog-card-link:hover {
        color: #1d4ed8;
        gap: 0.75rem;
    }
    .blog-card-link svg {
        width: 16px;
        height: 16px;
        transition: transform 0.2s ease;
    }
    .blog-card-link:hover svg {
        transform: translateX(2px);
    }
    .blog-card-share {
        color: #94a3b8;
        font-size: 0.875rem;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .blog-card-share:hover {
        color: #2563eb;
    }

    /* Newsletter Section */
    .newsletter-section {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        padding: 4rem 1.5rem;
        margin: 0 auto 4rem;
        max-width: 1200px;
        border-radius: 24px;
        position: relative;
        overflow: hidden;
    }
    .newsletter-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .newsletter-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        right: -5%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .newsletter-content {
        text-align: center;
        position: relative;
        z-index: 1;
        max-width: 700px;
        margin: 0 auto;
    }
    .newsletter-title {
        font-size: 2.25rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        font-style: italic;
    }
    .newsletter-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.125rem;
        line-height: 1.7;
        margin-bottom: 2rem;
    }
    .newsletter-form {
        display: flex;
        gap: 1rem;
        max-width: 500px;
        margin: 0 auto;
    }
    .newsletter-input {
        flex: 1;
        padding: 1rem 1.5rem;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.95);
        color: #0f172a;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }
    .newsletter-input::placeholder {
        color: #94a3b8;
    }
    .newsletter-input:focus {
        outline: none;
        background: white;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }
    .newsletter-button {
        padding: 1rem 2rem;
        background: white;
        color: #2563eb;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        white-space: nowrap;
    }
    .newsletter-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        background: #f8fafc;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 1.5rem;
    }
    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        opacity: 0.3;
    }
    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 0.5rem;
    }
    .empty-state-text {
        color: #64748b;
        font-size: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .blog-hero {
            padding: 3rem 1.5rem 2rem;
        }
        .blog-hero h1 {
            font-size: 2rem;
        }
        .blog-hero p {
            font-size: 1rem;
        }
        .blog-section {
            padding: 3rem 1.5rem;
        }
        .blog-section-title {
            font-size: 1.5rem;
        }
        .blog-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .newsletter-title {
            font-size: 1.75rem;
        }
        .newsletter-subtitle {
            font-size: 1rem;
        }
        .newsletter-form {
            flex-direction: column;
        }
        .newsletter-button {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="blog-hero">
    <div class="blog-hero-badge">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
        </svg>
        Panduan Wisata Bandung Terlengkap
    </div>
    <h1>
        Jelajahi Kota Kembang<br>
        <span class="highlight">Lebih Bermakna.</span>
    </h1>
    <p>
        Temukan rekomendasi tempat hits, kuliner autentik, hingga rute perjalanan<br>
        terbaik di Bandung dan sekitarnya bersama GoTour.
    </p>
</section>

<!-- Blog Section -->
<section class="blog-section">
    <div class="blog-section-header">
    </div>

    @if($posts->count() > 0)
        <div class="blog-grid">
            @foreach($posts as $post)
                <article class="blog-card">
                    <div class="blog-card-image-wrapper">
                        @if($post->cover_image)
                            <img src="{{ asset('storage/blog/'.basename($post->cover_image)) }}" alt="{{ $post->title }}" class="blog-card-image">
                        @else
                            <img src="https://via.placeholder.com/600x360/3b82f6/ffffff?text={{ urlencode($post->category ?? 'Blog') }}" alt="{{ $post->title }}" class="blog-card-image">
                        @endif
                        @if($post->category)
                            <span class="blog-card-category">{{ $post->category }}</span>
                        @endif
                    </div>
                    
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span class="blog-card-meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $post->reading_time ?? 5 }} min Bacaan
                            </span>
                            <span class="blog-card-meta-item">
                                {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="blog-card-title">{{ $post->title }}</h3>
                        
                        @if($post->excerpt)
                            <p class="blog-card-excerpt">{{ $post->excerpt }}</p>
                        @endif
                        
                        <div class="blog-card-footer">
                            @if($post->external_link)
                                <a href="{{ $post->external_link }}" target="_blank" rel="noopener noreferrer" class="blog-card-link">
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-link">
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                            <a href="#" class="blog-card-share">Bagikan Cerita ›</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <h3 class="empty-state-title">Belum Ada Artikel</h3>
            <p class="empty-state-text">Artikel blog akan segera hadir untuk Anda.</p>
        </div>
    @endif
</section>

<!-- Newsletter Section -->
<section class="blog-section">
    <div class="newsletter-section">
        <div class="newsletter-content">
            <h2 class="newsletter-title">Wilujeng Sumping di Bandung!</h2>
            <p class="newsletter-subtitle">
                Dapatkan voucher wisata dan rekomendasi tersembunyi langsung ke email Anda.<br>
                Khusus untuk penjelajah Bandung.
            </p>
            <form action="#" method="POST" class="newsletter-form">
                @csrf
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Alamat email Anda" 
                    class="newsletter-input"
                    required
                >
                <button type="submit" class="newsletter-button">Gabung Sekarang</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="blog-hero">
    <h1>Blog & Artikel</h1>
    <p>Tips perjalanan, destinasi, dan inspirasi wisata</p>
</div>

<div class="blog-container">
    @if($posts->isEmpty())
        <div style="text-align: center; padding: 3rem; color: #9ca3af;">
            <p style="font-size: 1.125rem;">Belum ada artikel blog tersedia</p>
        </div>
    @else
        <div class="blog-grid">
            @foreach($posts as $post)
                <article class="blog-card">
                    @if($post->cover_image)
                        <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" class="blog-cover">
                    @else
                        <div class="blog-cover" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1d5db" style="width: 64px; height: 64px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>
                        </div>
                    @endif
                    <div class="blog-content">
                        <h2 class="blog-title">{{ $post->title }}</h2>
                        @if($post->excerpt)
                            <p class="blog-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                        @endif
                        <div class="blog-meta">
                            <span class="blog-date">{{ optional($post->published_at)->format('d M Y') ?? $post->created_at->format('d M Y') }}</span>
                            <a href="#" class="blog-link">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
