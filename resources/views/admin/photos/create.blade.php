@extends('layouts.admin')

@section('title','Tambah Foto')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Tambah Foto Rekomendasi</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Upload foto rekomendasi wisata baru</p>
    </div>

    <form method="POST" action="{{ route('admin.photos.store') }}" enctype="multipart/form-data" class="card">
        @csrf
        
        <label class="form-label">Judul *
            <input name="title" placeholder="Contoh: Sunset di Pantai" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Gambar Foto *
            <input id="photoImage" type="file" name="image" class="form-input file-input" accept="image/*" required>
            <div style="margin-top: 0.6rem;"><img id="preview" class="preview-img" style="display: none;" alt="preview"></div>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Deskripsi
            <textarea name="description" placeholder="Deskripsi foto (opsional)" class="form-input" rows="3"></textarea>
        </label>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.photos.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('photoImage').addEventListener('change', function(e){
    const file = e.target.files[0];
    if (!file) {
        document.getElementById('preview').style.display = 'none';
        return;
    }
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
