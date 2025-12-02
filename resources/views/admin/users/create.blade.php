@extends('layouts.admin')

@section('title','Tambah User - Admin')

@section('content')
<div class="container2 my-8">
    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="card">
        @csrf
        <label class="form-label mb-2">Nama
            <input name="name" class="form-input" required>
        </label>

        <label class="form-label mb-2">Email
            <input name="email" type="email" class="form-input" required>
        </label>

        <label class="form-label mb-2">Password
            <input name="password" type="password" class="form-input" required>
        </label>

        <label class="form-label mb-2"><input type="checkbox" name="is_admin"> Jadikan admin</label>

        <div class="mt-4">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
