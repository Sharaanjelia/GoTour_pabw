@extends('layouts.admin')

@section('title','Edit Service')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <h1 class="text-2xl font-bold mb-3">Edit Layanan</h1>

    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        
        <label class="form-label mb-2">Nama Layanan
            <input type="text" name="name" value="{{ old('name', $service->name) }}" class="form-input" required>
        </label>
        <br>
        
        <label class="form-label mb-2">Deskripsi
            <textarea name="description" class="form-input" rows="4">{{ old('description', $service->description) }}</textarea>
        </label>
        <br>
        
        <label class="form-label mb-2">Foto Layanan (opsional)
            <input id="serviceImage" type="file" name="image" class="form-input file-input" accept="image/*">
            @if($service->image)
                <div style="margin-top:.6rem">
                    <img id="preview" class="preview-img" src="{{ asset('storage/' . $service->image) }}" alt="preview">
                </div>
            @else
                <div style="margin-top:.6rem">
                    <img id="preview" class="preview-img" src="https://via.placeholder.com/800x300?text=Preview" alt="preview">
                </div>
            @endif
        </label>
        <br>
        
        <div class="mt-4">
            <button class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="{{ route('admin.services.index') }}" class="ml-2 text-gray-600">Kembali</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('serviceImage').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
