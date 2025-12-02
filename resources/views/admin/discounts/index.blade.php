@extends('layouts.admin')

@section('title','Kelola Promo')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
            <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937;">Kelola Promo & Diskon</h1>
            <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary">+ Tambah Promo</a>
        </div>
        <p style="color: #6b7280; font-size: 0.875rem;">Kelola kode promo dan diskon untuk paket wisata</p>
    </div>

    @if($items->isEmpty())
        <div style="background: white; padding: 3rem; text-align: center; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #9ca3af; font-size: 1rem;">Belum ada promo tersedia</p>
            <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Tambah Promo Pertama</a>
        </div>
    @else
        <div style="display: grid; gap: 1rem;">
            @foreach($items as $it)
                <div style="background: #f9fafb; border-radius: 8px; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: transform 0.2s, box-shadow 0.2s;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="flex: 1;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                                <span style="background: linear-gradient(135deg, #0ea5a2 0%, #0d8e8b 100%); color: white; padding: 0.5rem 1rem; border-radius: 6px; font-weight: bold; font-size: 1.125rem; letter-spacing: 0.5px;">{{ $it->code }}</span>
                                <span style="background: #fef3c7; color: #92400e; padding: 0.375rem 0.75rem; border-radius: 6px; font-weight: 600; font-size: 0.875rem;">{{ $it->percent }}% OFF</span>
                            </div>
                            @if($it->description)
                                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">{{ $it->description }}</p>
                            @endif
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.discounts.edit', $it) }}" class="btn btn-primary" style="font-size: 0.875rem;">Edit</a>
                            <form action="{{ route('admin.discounts.destroy', $it) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus promo ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $items->links() }}
        </div>
    @endif
</div>
@endsection
