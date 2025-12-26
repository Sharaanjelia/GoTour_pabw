@extends('layouts.admin')

@section('title','Edit Post')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Edit Post Blog</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Perbarui artikel blog</p>
    </div>

    <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        
        <label class="form-label">Judul *
            <input name="title" value="{{ old('title', $post->title) }}" placeholder="Judul artikel" class="form-input" required>
        </label>
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; margin-top: 1rem;">
            <label class="form-label">Kategori
                <input name="category" placeholder="WISATA ALAM, KULINER BANDUNG, dll" class="form-input" value="{{ old('category', $post->category) }}">
            </label>
            
            <label class="form-label">Waktu Baca (menit)
                <input name="reading_time" type="number" placeholder="5" class="form-input" min="1" max="60" value="{{ old('reading_time', $post->reading_time ?? 5) }}">
            </label>
        </div>
        
        <label class="form-label" style="margin-top: 1rem;">Ringkasan
            <textarea name="excerpt" placeholder="Ringkasan singkat artikel" class="form-input" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Konten
            <textarea name="content" placeholder="Isi artikel lengkap" class="form-input" rows="8">{{ old('content', $post->content) }}</textarea>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Link Eksternal (Google/Artikel Lain)
            <input name="external_link" type="url" placeholder="https://www.google.com/search?q=..." class="form-input" value="{{ old('external_link', $post->external_link) }}">
            <small style="color: #6b7280; font-size: 0.875rem;">Jika diisi, tombol "Baca Selengkapnya" akan mengarah ke link ini</small>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Gambar Cover
            <input id="coverImage" type="file" name="cover_image" class="form-input file-input">
            @if($post->cover_image)
                <div style="margin-top: 0.6rem;">
                    <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">Gambar saat ini:</p>
                    <img id="preview" class="preview-img" src="{{ asset('storage/'.$post->cover_image) }}" alt="current cover">
                </div>
            @else
                <div style="margin-top: 0.6rem;"><img id="preview" class="preview-img" style="display: none;" alt="preview"></div>
            @endif
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Tanggal Publish
            <input name="published_at" type="date" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}" class="form-input">
        </label>
        
        <div style="margin-top: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" {{ $post->is_active ? 'checked' : '' }}> 
                <span style="font-weight: 500;">Aktif (Tampilkan di website)</span>
            </label>
        </div>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.blog.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('coverImage').addEventListener('change', function(e){
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev){ 
        const img = document.getElementById('preview');
        img.src = ev.target.result;
        img.style.display = 'block';
    }
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
