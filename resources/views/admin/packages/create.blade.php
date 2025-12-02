@extends('layouts.admin')

@section('title', 'Tambah Paket - Admin')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Tambah Paket Wisata</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Buat paket wisata baru untuk ditampilkan kepada pelanggan</p>
    </div>

    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf

        <label class="form-label mb-2">Judul
            <input type="text" name="title" class="form-input" required>
        </label>

        <label class="form-label mb-2">Ringkasan
            <textarea name="excerpt" class="form-input" rows="2"></textarea>
        </label>

        <label class="form-label mb-2">Deskripsi
            <textarea name="description" class="form-input" rows="6"></textarea>
        </label>

        <label class="form-label mb-2">Durasi
            <input type="text" name="duration" class="form-input">
        </label>

        <label class="form-label mb-2">Harga
            <input type="number" name="price" class="form-input">
        </label>

        <label class="form-label mb-2">Gambar Sampul
            <input id="coverImage" type="file" name="cover_image" class="form-input file-input">
            <div style="margin-top:.6rem"><img id="preview" class="preview-img" src="https://via.placeholder.com/800x300?text=Preview" alt="preview"></div>
        </label>

        <div class="flex gap-3 items-center mt-4">
            <label><input type="checkbox" name="featured"> Tampilkan sebagai featured</label>
            <label><input type="checkbox" name="is_active" checked> Aktif</label>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.packages.index') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>

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
</div>
@endsection
