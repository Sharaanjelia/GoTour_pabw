@extends('layouts.admin')

@section('title','Edit Foto')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Edit Foto Rekomendasi</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Perbarui informasi foto rekomendasi</p>
    </div>

    <form method="POST" action="{{ route('admin.photos.update', $photo) }}" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        
        <label class="form-label">Judul *
            <input name="title" value="{{ old('title', $photo->title) }}" placeholder="Contoh: Sunset di Pantai" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Gambar Foto
            <input id="photoImage" type="file" name="image" class="form-input file-input" accept="image/*">
            @if($photo->image)
                <div style="margin-top: 0.6rem;">
                    <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">Gambar saat ini:</p>
                    <img id="preview" class="preview-img" src="{{ asset('storage/'.$photo->image) }}" alt="current photo">
                </div>
            @else
                <div style="margin-top: 0.6rem;"><img id="preview" class="preview-img" style="display: none;" alt="preview"></div>
            @endif
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Deskripsi
            <textarea name="description" placeholder="Deskripsi foto (opsional)" class="form-input" rows="3">{{ old('description', $photo->description) }}</textarea>
        </label>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.photos.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('photoImage').addEventListener('change', function(e){
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
