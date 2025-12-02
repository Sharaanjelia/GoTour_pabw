@extends('layouts.admin')

@section('title','Kelola Testimoni')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937; margin-bottom: 0.5rem;">Testimoni</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Kelola testimoni pelanggan — review dan hapus.</p>
    </div>

    @if($items->count() > 0)
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $t)
                        <tr>
                            <td>
                                @if($t->photo_url)
                                    <img src="{{ $t->photo_url }}" alt="{{ $t->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 60px; height: 60px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; color: #d1d5db;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight: 600;">{{ $t->name }}</td>
                            <td style="color: #6b7280;">{{ $t->email }}</td>
                            <td style="max-width: 400px;">{{ Str::limit($t->message, 100) }}</td>
                            <td>
                                @if($t->approved)
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Approved</span>
                                @else
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Pending</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    @if(!$t->approved)
                                        <form action="{{ route('admin.testimonials.approve', $t) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" style="font-size: 0.875rem;">Approve</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn" style="background: #3b82f6; color: white; font-size: 0.875rem;">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus testimoni ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
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
            <p style="color: #9ca3af; font-size: 1rem;">Belum ada testimoni tersedia</p>
        </div>
    @endif
</div>
@endsection
