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
        <label class="form-label mb-2">Judul
            <input type="text" name="title" value="{{ old('title', $package->title) }}" class="form-input" required>
        </label>
        <br>
        <label class="form-label mb-2">Ringkasan
            <textarea name="excerpt" class="form-input" rows="2">{{ old('excerpt', $package->excerpt) }}</textarea>
        </label>
        <br>
        <label class="form-label mb-2">Deskripsi
            <textarea name="description" class="form-input" rows="6">{{ old('description', $package->description) }}</textarea>
        </label>
        <br>
        <label class="form-label mb-2">Durasi
            <input type="text" name="duration" value="{{ old('duration', $package->duration) }}" class="form-input">
        </label>
        <br>
        <label class="form-label mb-2">Harga
            <input type="number" name="price" value="{{ old('price', $package->price) }}" class="form-input">
        </label>
        <br>
        <label class="form-label mb-2">Gambar Sampul (opsional)
            <input id="coverImage" type="file" name="cover_image" class="form-input file-input">
            <div style="margin-top:.6rem"><img id="preview" class="preview-img" src="{{ $package->cover_image_url ?? 'https://via.placeholder.com/800x300?text=Preview' }}" alt="preview"></div>
        </label>
        <br>
        <div class="flex gap-3 items-center mt-4">
            <label><input type="checkbox" name="featured" {{ $package->featured ? 'checked' : '' }}> Tampilkan sebagai featured</label>
            <label><input type="checkbox" name="is_active" {{ $package->is_active ? 'checked' : '' }}> Aktif</label>
        </div>
        <br>
        <div class="mt-4">
            <button class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.packages.index') }}" class="ml-2 text-gray-600">Batal</a>
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
