@extends('layouts.app')

@section('title','Testimoni')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
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
        background-clip: text;
    }
    .form-section {
        background: white;
        border-radius: 20px;
        padding: 3rem 2.5rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        max-width: 900px;
        margin: 0 auto;
    }
    .form-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.75rem;
        text-align: center;
    }
    .form-subtitle {
        font-size: 1.1rem;
        color: #718096;
        margin-bottom: 2.5rem;
        text-align: center;
    }
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
        margin-bottom: 1.25rem;
    }
    .form-input {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f7fafc;
    }
    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    .form-textarea {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        resize: vertical;
        min-height: 150px;
        font-family: inherit;
        margin-bottom: 1.25rem;
        transition: all 0.3s ease;
        background: #f7fafc;
    }
    .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    .form-button {
        width: 100%;
        padding: 1.25rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    .form-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    }
    @media (max-width: 1200px) {
        .testimonials-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media (max-width: 900px) {
        .testimonials-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .testimonials-title {
            font-size: 2.5rem;
        }
        .form-row {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 600px) {
        .testimonials-grid {
            grid-template-columns: 1fr;
        }
        .testimonials-title {
            font-size: 2rem;
        }
        .form-section {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="testimonials-container">
    <div class="testimonials-hero">
        <h1 class="testimonials-title">Testimoni Pelanggan</h1>
        <p class="testimonials-subtitle">Cerita perjalanan indah dari pelanggan kami</p>
    </div>

    @if($items->count() > 0)
        <div class="testimonials-grid">
            @foreach($items as $t)
                <div class="testimonial-card">
                    <div class="testimonial-image-wrapper">
                        @if($t->photo_url)
                            <img src="{{ $t->photo_url }}" alt="{{ $t->name }}" class="testimonial-image">
                        @else
                            <div class="testimonial-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 80px; height: 80px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="testimonial-content">
                        <p class="testimonial-message">{{ $t->message }}</p>
                        <div class="testimonial-name">{{ $t->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="form-section">
        <h2 class="form-title">Berikan Testimoni Anda</h2>
        <p class="form-subtitle">Bagikan pengalaman perjalanan Anda bersama kami</p>
        
        <form method="POST" action="{{ route('testimoni.store') }}">
            @csrf
            <div class="form-row">
                <input name="name" placeholder="Nama Lengkap" class="form-input" required>
                <input name="email" type="email" placeholder="Email (opsional)" class="form-input">
            </div>
            <textarea name="message" class="form-textarea" placeholder="Tulis testimoni Anda di sini..." required></textarea>
            <button type="submit" class="form-button">Kirim Testimoni</button>
        </form>
    </div>
</div>
@endsection
