@extends('layouts.admin')

@section('title','Edit User - Admin')

@section('content')
<div class="container2 my-8">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="card">
        @csrf @method('PUT')
        <label class="form-label mb-2">Nama
            <input name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
        </label>

        <label class="form-label mb-2">Email
            <input name="email" type="email" value="{{ old('email', $user->email) }}" class="form-input" required>
        </label>

        <label class="form-label mb-2">Password (biarkan kosong jika tidak diubah)
            <input name="password" type="password" class="form-input">
        </label>

        <label class="form-label mb-2"><input type="checkbox" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}> Jadikan admin</label>

        <div class="mt-4">
            <button class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
