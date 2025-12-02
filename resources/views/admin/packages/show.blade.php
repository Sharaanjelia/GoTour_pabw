@extends('layouts.admin')

@section('title', 'Detail Paket - Admin')

@section('content')
<div class="container2 admin-tight mt-2 mb-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Detail Paket</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus paket ini?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>

    <div class="bg-white p-6 rounded shadow-sm">
        <div class="lg:flex lg:gap-6">
            <div class="lg:flex-1">
                <div style="height:360px; overflow:hidden; border-radius:10px;">
                    <img src="{{ $package->cover_image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80' }}" alt="{{ $package->title }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div class="mt-4 text-gray-700 leading-relaxed">{!! nl2br(e($package->description)) !!}</div>
            </div>

            <aside class="mt-4 lg:mt-0 bg-gray-50 p-4 rounded-lg w-80">
                <div class="mb-3"><strong>Judul</strong><div>{{ $package->title }}</div></div>
                <div class="mb-3"><strong>Slug</strong><div>{{ $package->slug }}</div></div>
                <div class="mb-3"><strong>Durasi</strong><div>{{ $package->duration }}</div></div>
                <div class="mb-3"><strong>Harga</strong><div>Rp {{ number_format($package->price ?? 0,0,',','.') }}</div></div>
                <div class="mb-3"><strong>Status</strong><div>{{ $package->is_active ? 'Aktif' : 'Non Aktif' }}</div></div>
            </aside>
        </div>
    </div>
</div>
@endsection
