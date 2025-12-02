@extends('layouts.admin')

@section('title', 'Kelola Users - Admin')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
            <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Kelola Users</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah User</a>
        </div>
        <p style="color: #6b7280; font-size: 0.875rem;">Kelola pengguna — tambah, edit, atau hapus user</p>
    </div>

    <div class="card">
        <form method="GET" style="margin-bottom: 1.5rem; display: flex; gap: 0.75rem; align-items: center;">
            <input name="q" value="{{ request('q') }}" placeholder="Cari nama / email" class="form-input" style="flex: 1; max-width: 400px;" />
            <button class="btn btn-primary">Cari</button>
            @if(request()->has('q'))
                <a href="{{ route('admin.users.index') }}" class="btn" style="background: #6b7280; color: white;">Reset</a>
            @endif
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td style="font-weight: 600;">{{ $u->name }}</td>
                    <td style="color: #6b7280;">{{ $u->email }}</td>
                    <td>
                        @if($u->is_admin)
                            <span style="background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Admin</span>
                        @else
                            <span style="background: #f3f4f6; color: #4b5563; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">User</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-primary" style="font-size: 0.875rem;">Edit</a>
                            <form action="{{ route('admin.users.toggleAdmin', $u) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn {{ $u->is_admin ? 'btn-danger' : '' }}" style="font-size: 0.875rem; {{ !$u->is_admin ? 'background: #3b82f6; color: white;' : '' }}">
                                    {{ $u->is_admin ? 'Revoke Admin' : 'Make Admin' }}
                                </button>
                            </form>
                            @if(auth()->id() !== $u->id)
                            <form action="{{ route('admin.users.destroy', $u) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus user ini?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
