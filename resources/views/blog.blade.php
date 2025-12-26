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
        <h1>Blog</h1>
        <p>Halaman blog utama.</p>
    </div>
    <div class="blog-container">
        <div class="blog-grid">
            <!-- Blog posts akan ditampilkan di sini -->
        </div>
    </div>
@endsection