@extends('layouts.admin')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="container2" style="padding-top: 0.5rem !important; margin-top: 0;">
    <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937; margin-bottom: 0.5rem;">Kelola Pembayaran</h1>
        <p style="color: #6b7280; font-size: 0.875rem;">Daftar semua transaksi pembayaran paket wisata</p>
    </div>

    @if($payments->count())
        <div class="card" style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Paket</th>
                        <th>Peserta</th>
                        <th>Tgl Keberangkatan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Metode</th>
                        <th>Dibuat</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                        <tr>
                            <td style="font-weight: 600;">#{{ $p->id }}</td>
                            <td>{{ optional($p->user)->name ?? '—' }}</td>
                            <td>{{ optional($p->package)->title ?? '—' }}</td>
                            <td>{{ $p->participants ?? '—' }}</td>
                            <td>{{ optional($p->travel_date)->format('d M Y') ?? '—' }}</td>
                            <td style="font-weight: 600;">Rp {{ number_format($p->amount ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @if($p->status === 'completed')
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Completed</span>
                                @elseif($p->status === 'pending')
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Pending</span>
                                @else
                                    <span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">{{ ucfirst($p->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $p->payment_method ?? '—' }}</td>
                            <td style="color: #6b7280; font-size: 0.875rem;">{{ $p->created_at->format('d M Y H:i') }}</td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.payments.show', $p) }}" class="btn btn-primary" style="font-size: 0.875rem;">Lihat</a>
                                    <a href="{{ route('admin.payments.edit', $p) }}" class="btn" style="background: #f59e0b; color: white; font-size: 0.875rem;">Edit</a>
                                    <form action="{{ route('admin.payments.destroy', $p) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus pembayaran ini?');">
                                        @csrf
                                        @method('DELETE')
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
            {{ $payments->links() }}
        </div>
    @else
        <div style="background: white; padding: 3rem; text-align: center; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #9ca3af; font-size: 1rem;">Belum ada pembayaran</p>
        </div>
    @endif
</div>
@endsection

