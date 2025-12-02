@extends('layouts.app')

@section('title', 'Blog')

@push('styles')
<style>
    body {
        background: #f9fafb;
    }
    .blog-hero {
        text-align: center;
        padding: 3rem 1.5rem;
        background: white;
        border-bottom: 1px solid #e5e7eb;
    }
    .blog-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }
    .blog-hero p {
        color: #6b7280;
        font-size: 1.125rem;
    }
    .blog-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
    }
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .blog-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }
    .blog-cover {
        width: 100%;
        height: 250px;
        object-fit: cover;
        background: #e5e7eb;
    }
    .blog-content {
        padding: 1.5rem;
    }
    .blog-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    .blog-excerpt {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    .blog-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }
    .blog-date {
        color: #9ca3af;
        font-size: 0.875rem;
    }
    .blog-link {
        color: #0ea5a2;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .blog-link:hover {
        color: #0d8e8b;
    }
    @media (max-width: 768px) {
        .blog-grid {
            grid-template-columns: 1fr;
        }
        .blog-hero h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush

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
