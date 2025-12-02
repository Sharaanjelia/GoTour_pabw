@extends('layouts.admin')

@section('title','Edit Diskon')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Edit Promo & Diskon</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Perbarui informasi kode promo</p>
    </div>

    <form method="POST" action="{{ route('admin.discounts.update', $discount) }}" class="card">
        @csrf
        @method('PUT')
        
        <label class="form-label">Kode Promo *
            <input name="code" value="{{ old('code', $discount->code) }}" placeholder="Contoh: SALE2024" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Persentase Diskon (%) *
            <input name="percent" type="number" min="1" max="100" value="{{ old('percent', $discount->percent) }}" placeholder="Contoh: 20" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Deskripsi
            <textarea name="description" placeholder="Deskripsi promo (opsional)" class="form-input" rows="3">{{ old('description', $discount->description) }}</textarea>
        </label>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.discounts.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>
@endsection
