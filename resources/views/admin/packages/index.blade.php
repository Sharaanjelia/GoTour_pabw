@extends('layouts.admin')

@section('title', 'Kelola Paket - Admin')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-3xl font-bold">Kelola Paket</h1>
            <div class="text-sm text-muted">Kelola paket wisata — tambah, edit, hapus, atau lihat detail.</div>
        </div>
        <div class="flex gap-2 items-center">
            <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">Tambah Paket</a>
        </div>
    </div>

    <div class="card">
        <form method="GET" class="mb-4 flex gap-3 items-center">
            <input name="q" value="{{ request('q') }}" placeholder="Cari paket, kata kunci..." class="px-3 py-2 rounded border w-1/2" />
            <select name="duration" class="px-3 py-2 rounded border">
                @php $dur = request('duration', 'all'); @endphp
                <option value="all" {{ $dur === 'all' ? 'selected' : '' }}>Semua Durasi</option>
                <option value="1 Hari 2 Malam" {{ $dur === '1 Hari 2 Malam' ? 'selected' : '' }}>1 Hari 2 Malam</option>
                <option value="2 Hari 2 Malam" {{ $dur === '2 Hari 2 Malam' ? 'selected' : '' }}>2 Hari 2 Malam</option>
                <option value="3 Hari 3 Malam" {{ $dur === '3 Hari 3 Malam' ? 'selected' : '' }}>3 Hari 3 Malam</option>
            </select>
            <button class="btn btn-primary">Cari</button>
            @if(request()->has('q') || request()->has('duration'))
                <a href="{{ route('admin.packages.index') }}" class="text-sm text-gray-500 ml-2">Reset</a>
            @endif
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-left text-sm text-gray-600 border-b">
                        <th class="py-2" style="width: 100px;">Gambar</th>
                        <th class="py-2">Judul</th>
                        <th class="py-2">Durasi</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2">Status</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $p)
                    <tr class="border-b">
                        <td class="py-3">
                            @if($p->cover_image_url)
                                <img src="{{ $p->cover_image_url }}" alt="{{ $p->title }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb;">
                            @else
                                <div style="width: 80px; height: 60px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.75rem;">No Image</div>
                            @endif
                        </td>
                        <td class="py-3"><strong>{{ $p->title }}</strong></td>
                        <td class="py-3">{{ $p->duration }}</td>
                        <td class="py-3"><strong>Rp {{ number_format($p->price ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="py-3">
                            <span style="display: inline-block; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700; background: {{ $p->is_active ? '#d1fae5' : '#fee2e2' }}; color: {{ $p->is_active ? '#065f46' : '#991b1b' }};">
                                {{ $p->is_active ? 'Aktif' : 'Non Aktif' }}
                            </span>
                        </td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.packages.show', $p) }}" class="btn btn-ghost">Lihat</a>
                            <a href="{{ route('admin.packages.edit', $p) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.packages.destroy', $p) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $packages->links() }}</div>
    </div>
</div>
@endsection
