@extends('layouts.admin')

@section('title','Kelola Foto')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
            <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Rekomendasi Foto</h1>
            <a href="{{ route('admin.photos.create') }}" class="btn btn-primary">+ Tambah Foto</a>
        </div>
        <p style="color: #6b7280; font-size: 0.875rem;">Kelola galeri foto rekomendasi wisata</p>
    </div>

    @if($items->count() > 0)
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $it)
                        <tr>
                            <td>
                                @if($it->image)
                                    <img src="{{ asset('storage/'.$it->image) }}" alt="{{ $it->title }}" style="width: 220px; height: 130px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb;">
                                @else
                                    <div style="width: 220px; height: 130px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 8px; border: 2px dashed #d1d5db; display: flex; align-items: center; justify-content: center; color: #d1d5db;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 64px; height: 64px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            <td style="font-weight: 600;">{{ $it->title }}</td>

                            <td style="color: #6b7280;">{{ $it->description }}</td>

                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.photos.edit', $it->id) }}" class="btn btn-primary" style="font-size: 0.875rem;">Edit</a>
                                    <form action="{{ route('admin.photos.destroy', $it->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $items->links() }}
        </div>
    @else
        <div style="background: white; padding: 3rem; text-align: center; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #9ca3af; font-size: 1rem;">Belum ada foto</p>
            <a href="{{ route('admin.photos.create') }}" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Tambah Foto Pertama</a>
        </div>
    @endif
</div>
@endsection