@extends('layouts.app')

@section('title','Testimoni')

@section('content')
    <div class="blog-hero">
        <h1>Testimoni pelanggan</h1>
        <p>Berbagai pengalaman dan review dari pelanggan GoTour.</p>
    </div>
    <div class="container mx-auto py-8">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem; color: #155724; background: #d4edda; border: 1px solid #c3e6cb; padding: 1rem; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif
        @if($items->count())
            <div class="testimonials-grid">
                @foreach($items as $testimonial)
                    <div class="testimonial-card">
                        <div class="testimonial-image-wrapper">
                            @if($testimonial->photo_url)
                                <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->name }}" class="testimonial-image">
                            @else
                                <div class="testimonial-placeholder">
                                    <span style="font-size:3rem;">&#128100;</span>
                                </div>
                            @endif
                        </div>
                        <div class="testimonial-content">
                            <div class="testimonial-message">{{ $testimonial->message }}</div>
                            @if(isset($testimonial->rating))
                                <div class="mb-2 text-yellow-500 font-bold">Rating: {{ $testimonial->rating }} / 5</div>
                            @endif
                            <div class="testimonial-name">{{ $testimonial->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="margin: 32px 0; text-align:center;">
                {{ $items->links() }}
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada testimoni yang tampil.</p>
        @endif
    </div>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
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
    .testimonials-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 1.5rem;
    }
    .testimonials-hero {
        text-align: center;
        margin-bottom: 4rem;
    }
    .testimonials-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    .testimonials-subtitle {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.9);
        font-weight: 300;
    }
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        margin-bottom: 4rem;
    }
    .testimonial-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
        position: relative;
    }
    .testimonial-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }
    .testimonial-image-wrapper {
        width: 100%;
        height: 280px;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .testimonial-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .testimonial-card:hover .testimonial-image {
        transform: scale(1.1);
    }
    .testimonial-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.7);
    }
    .testimonial-content {
        padding: 2rem 1.5rem;
        text-align: center;
    }
    .testimonial-message {
        font-size: 0.95rem;
        color: #4a5568;
        line-height: 1.7;
        margin-bottom: 1.5rem;
        font-style: italic;
        position: relative;
    }
    .testimonial-message::before {
        content: '"';
        font-size: 3rem;
        color: #667eea;
        opacity: 0.3;
        position: absolute;
        top: -20px;
        left: 0;
    }
    .testimonial-name {
        font-size: 1.1rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endpush
