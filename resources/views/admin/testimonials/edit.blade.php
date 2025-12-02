@extends('layouts.admin')

@section('title','Edit Testimoni')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Edit Testimoni</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Ubah informasi testimoni pelanggan</p>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        
        <label class="form-label">Nama *
            <input name="name" value="{{ old('name', $testimonial->name) }}" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Email
            <input name="email" type="email" value="{{ old('email', $testimonial->email) }}" class="form-input">
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Pesan *
            <textarea name="message" class="form-input" rows="4" required>{{ old('message', $testimonial->message) }}</textarea>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Foto Pelanggan
            <input id="testimonialPhoto" type="file" name="photo" class="form-input file-input" accept="image/*">
            <div style="margin-top: 0.6rem;">
                @if($testimonial->photo_url)
                    <img id="preview" src="{{ $testimonial->photo_url }}" class="preview-img" alt="preview">
                @else
                    <img id="preview" class="preview-img" style="display: none;" alt="preview">
                @endif
            </div>
        </label>
        
        <div style="margin-top: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="approved" {{ $testimonial->approved ? 'checked' : '' }}> 
                <span style="font-weight: 500;">Approved (Tampilkan di website)</span>
            </label>
        </div>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('testimonialPhoto').addEventListener('change', function(e){
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
