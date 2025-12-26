@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@push('styles')
<style>
    body {
        background: #faf8f5;
    }

    .success-container {
        max-width: 900px;
        margin: 3rem auto;
        padding: 0 1.5rem;
        min-height: calc(100vh - 200px);
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        box-shadow: 0 8px 24px rgba(52, 211, 153, 0.3);
    }

    .success-icon svg {
        width: 70px;
        height: 70px;
        stroke: #059669;
        stroke-width: 3;
        fill: none;
    }

    .success-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        text-align: center;
        margin-bottom: 1rem;
    }

    .success-subtitle {
        text-align: center;
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 3rem;
    }

    .eticket-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .eticket-header {
        background: linear-gradient(135deg, #ff7a18 0%, #ff9a44 100%);
        padding: 2.5rem;
        text-align: center;
        color: white;
    }

    .eticket-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .eticket-header p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .eticket-body {
        padding: 2.5rem;
    }

    .booking-id-section {
        background: #fef3e7;
        padding: 2rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 2rem;
    }

    .booking-id-label {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .booking-id-value {
        font-size: 2rem;
        font-weight: 700;
        color: #ff7a18;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        background: #fff7ed;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
        color: #ff7a18;
        font-size: 1.2rem;
    }

    .detail-content {
        flex: 1;
    }

    .detail-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.25rem;
    }

    .detail-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .info-grid {
        display: grid;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .info-icon {
        width: 24px;
        margin-right: 1rem;
        color: #6b7280;
    }

    .info-label {
        color: #6b7280;
        font-size: 0.95rem;
        flex: 1;
    }

    .info-value {
        color: #1a1a1a;
        font-weight: 600;
        text-align: right;
    }

    .date-box {
        background: #fef3e7;
        padding: 1.25rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 2rem;
    }

    .date-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ff7a18;
    }

    .payment-summary {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .payment-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .payment-row:last-child {
        border-bottom: none;
        padding-top: 1rem;
        margin-top: 0.5rem;
        border-top: 2px solid #ff7a18;
    }

    .payment-label {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .payment-value {
        font-weight: 600;
        color: #1a1a1a;
    }

    .payment-row:last-child .payment-label {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a1a;
    }

    .payment-row:last-child .payment-value {
        font-size: 1.5rem;
        color: #ff7a18;
        font-weight: 700;
    }

    .notes-section {
        background: #eff6ff;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .notes-title {
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .notes-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .notes-list li {
        color: #4b5563;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        padding-left: 1.5rem;
        position: relative;
    }

    .notes-list li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #3b82f6;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .action-buttons {
            grid-template-columns: 1fr;
        }
    }

    .btn {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-primary {
        background: linear-gradient(135deg, #ff7a18 0%, #ff9a44 100%);
        color: white;
        box-shadow: 0 4px 14px rgba(255, 122, 24, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 122, 24, 0.4);
    }

    .btn-secondary {
        background: white;
        color: #ff7a18;
        border-color: #ff7a18;
    }

    .btn-secondary:hover {
        background: #fff7ed;
    }

    .btn-tertiary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-tertiary:hover {
        background: #e5e7eb;
    }

    .contact-section {
        text-align: center;
        padding: 2rem 0;
        color: #6b7280;
    }

    .contact-section p {
        margin-bottom: 0.75rem;
        font-size: 1rem;
    }

    .contact-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .contact-link {
        color: #ff7a18;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-link:hover {
        color: #ff9a44;
    }
</style>
@endpush

@section('content')
<div class="success-container">
    <!-- Success Icon -->
    <div class="success-icon">
        <svg viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    </div>

    <!-- Success Message -->
    <h1 class="success-title">Pembayaran Berhasil!</h1>
    <p class="success-subtitle">E-Ticket Anda telah dikirim ke email {{ $payment->email }}</p>

    <!-- E-Ticket Card -->
    <div class="eticket-card">
        <!-- Header -->
        <div class="eticket-header">
            <h2>E-TICKET PERJALANAN</h2>
            <p>GoTour Indonesia</p>
        </div>

        <!-- Body -->
        <div class="eticket-body">
            <!-- Booking ID -->
            <div class="booking-id-section">
                <div class="booking-id-label">ID Pesanan</div>
                <div class="booking-id-value">GT{{ str_pad($payment->id, 8, '0', STR_PAD_LEFT) }}</div>
            </div>

            <!-- Package Details -->
            <h3 class="section-title">Detail Paket Wisata</h3>
            
            <div class="detail-item">
                <div class="detail-icon">📍</div>
                <div class="detail-content">
                    <div class="detail-title">{{ $payment->package->title ?? 'N/A' }}</div>
                    <div class="detail-subtitle">{{ $payment->package->excerpt ?? 'Paket wisata pilihan' }}</div>
                </div>
            </div>

            @if($payment->package && $payment->package->duration)
            <div class="detail-item">
                <div class="detail-icon">⏱️</div>
                <div class="detail-content">
                    <div class="detail-title">Durasi</div>
                    <div class="detail-subtitle">{{ $payment->package->duration }}</div>
                </div>
            </div>
            @endif

            <!-- Customer Information -->
            <h3 class="section-title">Informasi Pemesan</h3>
            
            <div class="info-grid">
                <div class="info-row">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $payment->full_name }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-icon">✉️</span>
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $payment->email }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-icon">📱</span>
                    <span class="info-label">Telepon</span>
                    <span class="info-value">{{ $payment->phone }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-icon">👥</span>
                    <span class="info-label">Jumlah Peserta</span>
                    <span class="info-value">{{ $payment->participants }} orang</span>
                </div>
            </div>

            <!-- Travel Date -->
            <h3 class="section-title">Tanggal Keberangkatan</h3>
            <div class="date-box">
                <div class="date-value">
                    @if($payment->travel_date)
                        {{ $payment->travel_date->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    @else
                        Belum ditentukan
                    @endif
                </div>
            </div>

            <!-- Payment Summary -->
            <h3 class="section-title">Rincian Pembayaran</h3>
            <div class="payment-summary">
                <div class="payment-row">
                    <span class="payment-label">Harga per orang</span>
                    <span class="payment-value">Rp {{ number_format($payment->package->price ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Jumlah peserta</span>
                    <span class="payment-value">{{ $payment->participants }} orang</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Total Pembayaran</span>
                    <span class="payment-value">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="notes-section">
                <div class="notes-title">Catatan Penting:</div>
                <ul class="notes-list">
                    <li>Harap datang 30 menit sebelum waktu keberangkatan</li>
                    <li>Bawa E-ticket ini (digital atau print) saat keberangkatan</li>
                    <li>Pastikan membawa identitas yang valid (KTP/Paspor)</li>
                    <li>Hubungi customer service untuk perubahan jadwal</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn btn-tertiary">
                    🏠 Kembali ke Beranda
                </a>
                <a href="{{ route('paket.index') }}" class="btn btn-secondary">
                    🔄 Ganti Paket Wisata
                </a>
                <a href="#" onclick="window.print(); return false;" class="btn btn-primary">
                    ⬇️ Unduh E-Ticket
                </a>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <p>Butuh bantuan? Hubungi Customer Service kami</p>
        <div class="contact-links">
            <a href="tel:+622112345678" class="contact-link">
                📞 +62 21 1234 5678
            </a>
            <span style="color: #d1d5db;">|</span>
            <a href="mailto:cs@gotour.id" class="contact-link">
                ✉️ cs@gotour.id
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.scrollTo(0, 0);

const style = document.createElement('style');
style.textContent = `
    @media print {
        body * { visibility: hidden; }
        .eticket-card, .eticket-card * { visibility: visible; }
        .eticket-card { position: absolute; left: 0; top: 0; width: 100%; }
        .action-buttons, .contact-section { display: none !important; }
    }
`;
document.head.appendChild(style);
</script>
@endpush
@endsection