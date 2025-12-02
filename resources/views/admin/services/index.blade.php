@extends('layouts.admin')

@section('title','Kelola Layanan')

@push('styles')
<style>
    .admin-header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }
    .admin-page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1a1a1a;
    }
    .btn-add {
        padding: 0.75rem 1.5rem;
        background: #10b981;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .btn-add:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .services-table-wrapper {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    .services-table {
        width: 100%;
        border-collapse: collapse;
    }
    .services-table thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }
    .services-table th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .services-table th:last-child {
        text-align: center;
        width: 150px;
    }
    .services-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s ease;
    }
    .services-table tbody tr:hover {
        background: #f9fafb;
    }
    .services-table tbody tr:last-child {
        border-bottom: none;
    }
    .services-table td {
        padding: 1.25rem;
        vertical-align: middle;
    }
    .service-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        display: block;
    }
    .service-placeholder {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-radius: 8px;
        border: 2px dashed #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 0.75rem;
        font-weight: 500;
        text-align: center;
        padding: 0.5rem;
    }
    .service-image-wrapper {
        width: 80px;
        height: 80px;
        position: relative;
        overflow: hidden;
    }
    .service-name {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.95rem;
    }
    .service-description {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.5;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    .btn-edit {
        padding: 0.5rem 1rem;
        background: #3b82f6;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .btn-edit:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }
    .btn-delete {
        padding: 0.5rem 1rem;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }
    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #6b7280;
        font-size: 1rem;
    }
</style>
@endpush

@section('content')
<div class="p-6">
    <div class="admin-header-section">
        <h1 class="admin-page-title">Kelola Layanan</h1>
        <a href="{{ route('admin.services.create') }}" class="btn-add">+ Tambah Layanan</a>
    </div>
    
    @if($services->count() > 0)
        <div class="services-table-wrapper">
            <table class="services-table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Layanan</th>
                        <th>Deskripsi</th>
                        <th>Tombol</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($services as $s)
                        <tr>
                            <td>
                                <div class="service-image-wrapper">
                                    @if($s->image_url)
                                        <img src="{{ $s->image_url }}" alt="{{ $s->name }}" class="service-thumbnail">
                                    @else
                                        <div class="service-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; height: 32px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div class="service-name">{{ $s->name }}</div>
                            </td>

                            <td>
                                <div class="service-description">{{ $s->description }}</div>
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.services.edit', $s) }}" class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.services.destroy', $s) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrapper">
            {{ $services->links() }}
        </div>
    @else
        <div class="services-table-wrapper">
            <div class="empty-state">
                Belum ada layanan. Klik "Tambah Layanan" untuk menambahkan.
            </div>
        </div>
    @endif
</div>
@endsection
