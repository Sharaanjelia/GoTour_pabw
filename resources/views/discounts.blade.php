@extends('layouts.app')

@section('title', 'Discounts')

@push('styles')
<style>
    body {
        background: #f9fafb;
    }
    .discounts-hero {
        text-align: center;
        padding: 3rem 1.5rem;
        background: linear-gradient(135deg, #0ea5a2 0%, #0d8e8b 100%);
        color: white;
    }
    .discounts-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .discounts-hero p {
        font-size: 1.125rem;
        opacity: 0.95;
    }
    .discounts-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
    }
    .discounts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    .discount-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .discount-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        border-color: #0ea5a2;
    }
    .discount-code {
        display: inline-block;
        background: linear-gradient(135deg, #0ea5a2 0%, #0d8e8b 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 1px;
        margin-bottom: 1rem;
    }
    .discount-percent {
        background: #fef3c7;
        color: #92400e;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.25rem;
        display: inline-block;
        margin-left: 1rem;
    }
    .discount-description {
        color: #6b7280;
        font-size: 1rem;
        line-height: 1.6;
        margin-top: 1rem;
    }
    @media (max-width: 768px) {
        .discounts-grid {
            grid-template-columns: 1fr;
        }
        .discounts-hero h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush
