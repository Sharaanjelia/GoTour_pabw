@extends('layouts.app')

@section('title', 'Rekomendasi Foto')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/photos.css') }}">
@endpush

<div class="photos-wrap">
    <h1 class="photos-heading">Rekomendasi Foto</h1>

    <div class="photos-grid">
        @foreach($items as $it)
            <div class="photo-card">
                @if($it->image)
                    <div class="photo-card__image">
                        <img src="{{ $it->image_url ?? asset('images/download.jpeg') }}" alt="{{ $it->title }}" onerror="this.onerror=null;this.src='{{ asset('images/download.jpeg') }}';">
                    </div>
                @endif

                <div class="photo-card__body">
                    <div class="photo-card__title">{{ $it->title }}</div>
                    @if($it->description)
                        <p class="photo-card__category">Kategori: {{ $it->description }}</p>
                    @else
                        <p class="photo-card__category">&nbsp;</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="photos-pagination">{{ $items->links() }}</div>
</div>
@endsection
