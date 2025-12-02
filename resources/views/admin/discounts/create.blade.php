@extends('layouts.admin')

@section('title','Tambah Diskon')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Tambah Promo & Diskon</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Buat kode promo dan diskon baru</p>
    </div>

    <form method="POST" action="{{ route('admin.discounts.store') }}" class="card">
        @csrf
        
        <label class="form-label">Kode Promo *
            <input name="code" placeholder="Contoh: SALE2024" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Persentase Diskon (%) *
            <input name="percent" type="number" min="1" max="100" placeholder="Contoh: 20" class="form-input" required>
        </label>
        
        <label class="form-label" style="margin-top: 1rem;">Deskripsi
            <textarea name="description" placeholder="Deskripsi promo (opsional)" class="form-input" rows="3"></textarea>
        </label>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 0.5rem;">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.discounts.index') }}" class="btn" style="background: #6b7280; color: white;">Batal</a>
        </div>
    </form>
</div>
@endsection
