@extends('layouts.admin')

@section('title','Kelola Blog')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
            <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Kelola Blog</h1>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">+ Tambah Post</a>
        </div>
        <p style="color: #6b7280; font-size: 0.875rem;">Kelola artikel dan konten blog</p>
    </div>

    @if($posts->isEmpty())
        <div style="background: white; padding: 3rem; text-align: center; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #9ca3af; font-size: 1rem;">Belum ada post blog</p>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Buat Post Pertama</a>
        </div>
    @else
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal Publish</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $p)
                        <tr>
                            <td style="font-weight: 600;">{{ $p->title }}</td>
                            <td>{{ optional($p->published_at)->format('d M Y') ?? '-' }}</td>
                            <td>
                                @if($p->is_active)
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Active</span>
                                @else
                                    <span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Inactive</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.blog.edit', $p) }}" class="btn btn-primary" style="font-size: 0.875rem;">Edit</a>
                                    <form method="POST" action="{{ route('admin.blog.destroy', $p) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus post ini?')">
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
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
