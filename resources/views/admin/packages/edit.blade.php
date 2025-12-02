@extends('layouts.admin')

@section('title', 'Edit Paket - Admin')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Edit Paket Wisata</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Perbarui informasi paket wisata</p>
    </div>

    <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf @method('PUT')
        
        <label class="form-label">Judul Paket *
            <input type="text" name="title" value="{{ old('title', $package->title) }}" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Ringkasan
            <textarea name="excerpt" class="form-input" rows="2" placeholder="Ringkasan singkat untuk preview">{{ old('excerpt', $package->excerpt) }}</textarea>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Deskripsi Lengkap
            <textarea name="description" class="form-input" rows="6" placeholder="Deskripsi detail paket wisata">{{ old('description', $package->description) }}</textarea>
        </label>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
            <label class="form-label">Durasi
                <input type="text" name="duration" value="{{ old('duration', $package->duration) }}" class="form-input" placeholder="Contoh: 2 Hari 1 Malam">
            </label>
            
            <label class="form-label">Harga per Orang
                <input type="number" name="price" value="{{ old('price', $package->price) }}" class="form-input" placeholder="Contoh: 2000000">
            </label>
        </div>
        
        <label class="form-label" style="margin-top: 1rem;">Gambar Sampul
            <input id="coverImage" type="file" name="cover_image" class="form-input file-input" accept="image/*">
            <div style="margin-top: 0.6rem;">
                <img id="preview" class="preview-img" src="{{ $package->cover_image_url ?? 'https://via.placeholder.com/800x300?text=Preview' }}" alt="preview">
            </div>
        </label>
        
        <div style="margin-top: 1rem; display: flex; gap: 2rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="featured" {{ $package->featured ? 'checked' : '' }}> 
                <span style="font-weight: 500;">Featured (Tampilkan di halaman utama)</span>
            </label>
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" {{ $package->is_active ? 'checked' : '' }}> 
                <span style="font-weight: 500;">Aktif (Tampilkan di website)</span>
            </label>
        </div>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Perbarui Paket</button>
            <a href="{{ route('admin.packages.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('coverImage').addEventListener('change', function(e){
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev){ document.getElementById('preview').src = ev.target.result; }
    reader.readAsDataURL(file);
});
</script>
@endpush
